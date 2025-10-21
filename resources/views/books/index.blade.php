<!DOCTYPE html>
<html>
<head>
    <title>Books List</title>
</head>
<body>
    <h1>List of Books</h1>
    <ul>
        @foreach ($books as $book)
            <li>
                <strong>{{ $book->title }}</strong> by {{ $book->author->name }} <br>
                Price: Rp{{ number_format($book->price) }} | Stock: {{ $book->stock }}
            </li>
        @endforeach
    </ul>
</body>
</html>
