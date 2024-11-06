<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Daftar Pertanyaan</h1>
    <a href="{{ route('questions.create') }}">Buat Pertanyaan Baru</a>
    <ul>
        @foreach ($questions as $question)
            <li>
                <strong>{{ $question->content }}</strong>
                <ul>
                    @foreach ($question->options as $option)
                        <li>{{ $option->content }} @if($option->is_correct) (Benar) @endif</li>
                    @endforeach
                </ul>
                <a href="{{ route('questions.edit', $question->id) }}">Edit</a>
                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>