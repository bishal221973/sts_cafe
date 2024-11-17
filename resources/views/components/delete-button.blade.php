<form action="{{ $url }}" method="POST" style="display:inline;">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
        Delete
    </button>
</form>
