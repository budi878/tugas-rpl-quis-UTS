<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Buat Pertanyaan Baru</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <label for="content">Pertanyaan:</label>
        <textarea name="content" id="content" rows="4"></textarea>
        <br>

        <h3>Pilihan Jawaban:</h3>
        <div>
            <input type="text" name="options[]" placeholder="Pilihan 1">
            <input type="checkbox" name="correct_option" value="0"> Benar
        </div>
        <div>
            <input type="text" name="options[]" placeholder="Pilihan 2">
            <input type="checkbox" name="correct_option" value="1"> Benar
        </div>
        <div>
            <input type="text" name="options[]" placeholder="Pilihan 3">
            <input type="checkbox" name="correct_option" value="2"> Benar
        </div>
        <div>
            <input type="text" name="options[]" placeholder="Pilihan 3">
            <input type="checkbox" name="correct_option" value="2"> Benar
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>