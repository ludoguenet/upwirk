@extends('layouts.app')

@section('content')
  <h1 class="text-3xl text-green-500">Tableau de bord</h1>
  <div class="flex flex-col md:flex-row">
  <section class="text-gray-700 w-full w-1/3 mr-5">
  <h2 class="text-xl my-2"><svg class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
        <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
      </svg> Vos propositions ({{ $proposals->count() }})</h2>
    @foreach($proposals as $proposal)
    <div class="mb-3 {{ $proposal->validated ? 'text-green-400' : '' }}">
    <span class="block font-semibold items-center">
       Pour la mission "{{ $proposal->job->title }}"
    </span>
    <span>Lettre de motivation : <span class="font-semibold">{{ $proposal->coverLetter->content }}</span></span>
    </div>
    @endforeach
  </section>

  <section class="text-sm text-gray-700 w-full w-1/3 mr-5">
  <h2 class="text-xl my-2"><svg class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg> Vos missions favorites ({{ auth()->user()->likes()->count() }})</h2>
    @foreach(auth()->user()->likes as $like)
    <div class="mb-3">
    <span class="block font-semibold">
    {{ $like->title }}
    </span>
    </div>
    @endforeach
  </section>


  <section class="text-sm text-gray-700 w-full">
    <h2 class="text-xl my-2">
    <svg class="w-6 h-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
    </svg>
    Vos missions ({{ auth()->user()->jobs()->count() }})</h2>
    @foreach(auth()->user()->jobs as $job)
    <div class="mb-3">
      <span class="block font-semibold">
        {{ $job->title }} ({{ $job->proposals->count() }} @choice('proposition|propositions', $job->proposals)) :</span>
      </span>
      <ul class="list-none ml-4">
      @foreach($job->proposals as $proposal)
      <li class="mt-2">• "{{ $proposal->coverLetter->content }}" par
      <strong>
      {{ $proposal->user->name }}
      </strong>
      </li>
      @if ($proposal->validated)
      <span class="bg-white border border-green-500 text-xs p-1 my-2 inline-block text-green-500 rounded">Déjà validé</span>
      @else
      <a href="{{ route('confirm.proposal', [$proposal->id])}}" class="bg-green-500 text-xs py-2 px-2 mt-2 mb-3 inline-block text-white hover:bg-green-200 hover:text-green-500 duration-200 transition rounded">Valider la proposition</a>
      @endif
      @endforeach
      </ul>
    </div>
    @endforeach
  </section>
  </div>
@endsection
