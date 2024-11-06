<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Edit Pertanyaan</h1>
    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="content">Pertanyaan:</label>
        <textarea name="content" id="content" rows="4">{{ $question->content }}</textarea>
        <br>

        <h3>Pilihan Jawaban:</h3>
        @foreach ($question->options as $key => $option)
            <div>
                <input type="text" name="options[{{ $option->id }}]" value="{{ $option->content }}">
                <input type="checkbox" name="correct_option" value="{{ $option->id }}" {{ $option->is_correct ? 'checked' : '' }}> Benar
            </div>
        @endforeach
        <button type="submit">Perbarui</button>
    </form>
</body>
</html>