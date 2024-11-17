<div class="d-flex justify-content-between notPrint">
    <label>Showing
        {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
    </label>
    {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
