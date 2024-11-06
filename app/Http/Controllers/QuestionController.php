<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Menampilkan daftar semua pertanyaan.
     */
    public function index()
    {
        $questions = Question::with('options')->get(); // Menampilkan pertanyaan beserta pilihannya
        return view('questions.index', compact('questions'));
    }

    /**
     * Menampilkan form untuk membuat pertanyaan baru.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Menyimpan pertanyaan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $question = Question::create([
            'content' => $request->content,
        ]);

        // Menyimpan pilihan jawaban jika ada
        foreach ($request->options as $key => $value) {
            $question->options()->create([
                'content' => $value,
                'is_correct' => $request->correct_option == $key, // Menandai jawaban benar
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit pertanyaan.
     */
    public function edit($id)
    {
        $question = Question::with('options')->findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    /**
     * Memperbarui pertanyaan dan pilihan jawaban.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'content' => $request->content,
        ]);

        // Mengupdate pilihan jawaban
        foreach ($request->options as $key => $value) {
            $option = Option::find($key);
            if ($option) {
                $option->update([
                    'content' => $value,
                    'is_correct' => $request->correct_option == $key,
                ]);
            }
        }

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Menghapus pertanyaan beserta pilihannya.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->options()->delete(); // Menghapus pilihan jawaban terkait
        $question->delete(); // Menghapus pertanyaan

        return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}