<a href="{{ $system->url }}"
   @if($system->open_new_tab) target="_blank" rel="noopener noreferrer" @endif
   class="group flex flex-col items-center gap-3 p-5 bg-white hover:bg-primary/5 rounded-xl border border-slate-200 hover:border-primary/20 hover:shadow-md transition-all duration-200 cursor-pointer text-center">
    @if($system->logo)
    <img src="{{ asset('storage/' . $system->logo) }}" alt="{{ $system->name }}" class="w-14 h-14 object-contain">
    @else
    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold text-2xl"
         style="background-color: {{ $system->color ?? '#1E3A5F' }}">
        {{ mb_substr($system->name, 0, 1) }}
    </div>
    @endif
    <span class="text-sm font-medium text-slate-700 group-hover:text-primary transition-colors leading-tight">{{ $system->name }}</span>
    @if($system->description)
    <span class="text-xs text-slate-400 line-clamp-2 leading-snug">{{ $system->description }}</span>
    @endif
</a>
