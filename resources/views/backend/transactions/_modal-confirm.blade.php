<!-- Confirm Payment Modal -->
<div class="modal fade" id="confirmPaymentModal" tabindex="-1">
    <form action="{{ route('panel.transaction.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to confirm this payment?</p>
                    <p><strong>Transaction #{{ $transaction->code }}</strong></p>
                    <p>Amount: Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="status" value="success">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-check-circle me-1"></i> Confirm
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
