<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Gallery Management</h1>
        <a href="{{ route('admin.gallery.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Add New Image
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Added</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($galleries as $gallery)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="data:image/jpeg;base64,{{ $gallery->image }}" alt="{{ $gallery->img_name }}" class="h-16 w-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->img_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->category }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($gallery->description, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $gallery->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="redirectToShow({{ $gallery->id }})" class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                            <button wire:click="edit({{ $gallery->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $gallery->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No gallery images found. Add your first image to get started.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>