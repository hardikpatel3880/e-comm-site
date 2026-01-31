@extends('layouts.app')

@section('content')

<style>

        .gallery-img {
            width: 100px;
            /* max-width: 300px; */
            /* Limit width on mobile */
            height: 100px;
            /* Maintain aspect ratio */
        }
    
    @media (max-width: 576px) {
        .image-gallery-wrapper {
            flex-direction: column;
            align-items: center;
        }

        .gallery-img {
            width: 100px;
            /* max-width: 300px; */
            /* Limit width on mobile */
            height: 100px;
            /* Maintain aspect ratio */
        }
    }
</style>

@session('success')
<div class="alert alert-success" role="alert">
    {{ $value }}
</div>
@endsession
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-table me-1"></i>
            Slider Management
        </div>
        <a class="btn btn-success mb-2" href="{{ route('slider.create') }}"><i class="fa fa-plus"></i>
            Slider</a>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>SortOrder</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slider as $index => $slider)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-center">
                        @if ($slider->image)
                        <div class="image-gallery-wrapper">
                            <img src="{{ url('collection/slider/image/'.$slider->image) }}" 
                                style="object-fit: cover;" class="gallery-img" alt="Thumbnail">
                        </div>
                        @else
                        <span class="text-muted">No image</span>
                        @endif

                    </td>
                    <td>{{ $slider->sortOrder }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ route('slider.edit', $slider->id) }}"><i
                                class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{route('slider.delete', $slider->id)}}"><i
                                class="fa fa-trash"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection