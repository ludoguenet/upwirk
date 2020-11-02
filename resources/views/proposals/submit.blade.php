@extends('layouts.app')

@section('content')
<h2 class="text-2xl text-green-500 mb-5">Vous soumettez une proposition pour la mission "{{ $jobId->title }}"</h2>
<form method="POST" action="{{ route('proposals.submit.store', $jobId) }}" class="w-full max-w-md">
  @csrf
  <h3 class="text-green-700">Lettre de motivation</h3>
  <textarea name="coverLetter" class="border w-full rounded block py-2 px-3"></textarea>
  @error('coverLetter')
    <span class="text-red-400 text-sm">{{ $message }}</span>
  @enderror
  <button type="submit" class="bg-green-500 text-white hover:bg-green-700 transition ease-in-out duration-500 rounded-md shadow-md w-full block px-4 py-2 mt-3">Envoyez ma candidature</button>
</form>
@endsection