<x-filament-panels::page>
    <div class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold text-primary-600">
            {{ $this->record->title }}
        </h2>
        <p class="text-gray-600">
            {{ $this->record->description }}
        </p>
        {{-- {{dd($this->record->poll_questions)}} --}}

        <!-- Gráficos de barras de ancho completo -->
        @foreach($this->record->poll_questions as $question)
            @if($question->type === \App\Enums\QuestionType::PERCENTAGE)
                <x-filament::section>
                    <x-slot name="heading">
                        {{ $question->title }}
                    </x-slot>
                    <livewire:perc-chart :question="$question" :key="$question->id" />
                </x-filament::section>
            @endif
        @endforeach

        <!-- Gráficos booleanos en grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($this->record->poll_questions as $question)
                @if($question->type === \App\Enums\QuestionType::BOOLEAN)
                    <x-filament::section>
                        <x-slot name="heading">
                            {{ $question->title }}
                        </x-slot>
                        <livewire:boolean-chart :question="$question" :key="$question->id" />
                    </x-filament::section>
                @endif
            @endforeach
        </div>

        <!-- Tablas de texto -->
        @foreach($this->record->poll_questions as $question)
            @if($question->type === \App\Enums\QuestionType::TEXT)
                <x-filament::section>
                    <x-slot name="heading">
                        {{ $question->title }}
                    </x-slot>
                    <div class="mt-2">
                        <livewire:text-answers-table :question="$question" :key="$question->id" />
                    </div>
                </x-filament::section>
            @endif
        @endforeach
    </div>
</x-filament-panels::page>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
