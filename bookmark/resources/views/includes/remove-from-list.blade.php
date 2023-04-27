<form method='GET' action='/list/{{ $book->slug }}/delete'>
    {{ csrf_field() }}

    <button type='submit' class='button-link' test='{{ $book->slug }}-remove-from-list-button'>
        <i class='fa fa-minus-circle'></i> Remove from list
    </button>
</form>
