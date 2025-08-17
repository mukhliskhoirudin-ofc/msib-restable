<!-- Reject Payment Modal -->
<div class="modal fade" id="rejectPaymentModal" tabindex="-1">
    <form action="{{ route('panel.transaction.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this payment?</p>
                    <p><strong>Transaction #{{ $transaction->code }}</strong></p>
                    <p>Amount: Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                    <textarea name="reason" class="form-control" placeholder="Alasan penolakan"></textarea>
                    <input type="hidden" name="status" value="failed">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-x-circle me-1"></i>
                        Reject Payment
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
