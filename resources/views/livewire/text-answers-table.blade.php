<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Autor
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Respuesta
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($answers as $answer)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $answer->user->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $answer->answer }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500">
                            No hay respuestas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Mostrando
            <span class="font-medium">{{ $answers->firstItem() }}</span>
            a
            <span class="font-medium">{{ $answers->lastItem() }}</span>
            de
            <span class="font-medium">{{ $answers->total() }}</span>
            resultados
        </div>
        <div>
            {{ $answers->links() }}
        </div>
    </div>
</div> 