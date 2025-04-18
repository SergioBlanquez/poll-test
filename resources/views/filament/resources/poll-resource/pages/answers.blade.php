<x-filament-panels::page>
    <div class="flex flex-col gap-4">
        <h2 class="text-2xl font-bold text-primary-600">
            {{ $this->record->title }}
        </h2>
        <p class="text-gray-600">
            {{ $this->record->description }}
        </p>
        {{-- {{dd($this->record->poll_questions)}} --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($this->record->poll_questions as $question)
                @if($question->type !== \App\Enums\QuestionType::TEXT)
                    <x-filament::section>
                        <x-slot name="heading">
                            {{ $question->title }}
                        </x-slot>
                        @if($question->type === \App\Enums\QuestionType::BOOLEAN)
                            {{-- <livewire:charts.boolean-chart :question="$question" :key="$question->id" /> --}}
                            <p>boolean</p>

                        @elseif($question->type === \App\Enums\QuestionType::PERCENTAGE)
                            {{-- <livewire:charts.percentage-bar-chart :question="$question" :key="$question->id" /> --}}
                            <p>percentage</p>
                        @endif
                    </x-filament::section>
                @endif
            @endforeach
        </div>

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
