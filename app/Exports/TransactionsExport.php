<?php

namespace App\Exports;

use App\Models\Transaction;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $search;
    protected $status;
    protected $startDate;
    protected $endDate;

    public function __construct($search = null, $status = null, $startDate = null, $endDate = null)
    {
        $this->search = $search;
        $this->status = $status;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        $query = Transaction::query()
            ->select([
                'code',
                'type',
                'name',
                'email',
                'phone',
                'date',
                'time',
                'people',
                'amount',
                'status',
                'message',
                'created_at'
            ]);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            ['LAPORAN TRANSAKSI'],
            ['Periode: ' . $this->startDate . ' - ' . $this->endDate],
            ['Filter Status: ' . ($this->status ?? 'Semua')],
            [],
            [ // Kolom header
                'Kode',
                'Tipe',
                'Nama',
                'Email',
                'Telepon',
                'Tanggal',
                'Waktu',
                'Orang',
                'Jumlah',
                'Status',
                'Pesan',
                'Dibuat Pada'
            ]
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->code,
            $transaction->type,
            $transaction->name,
            $transaction->email,
            $transaction->phone,
            $transaction->date,
            $transaction->time,
            $transaction->people,
            'Rp ' . number_format($transaction->amount, 0, ',', '.'),
            ucfirst($transaction->status),
            $transaction->message,
            $transaction->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for title and center it
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:L2');
        $sheet->mergeCells('A3:L3');

        // Set alignment for title and headers
        $sheet->getStyle('A1:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A5:L5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Apply borders to all data cells (from row 5 to last row)
        $lastRow = $sheet->getHighestRow();
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A5:L' . $lastRow)->applyFromArray($borderStyle);

        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ],
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            5 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFD3D3D3'],
                ],
            ],
        ];
    }
}
