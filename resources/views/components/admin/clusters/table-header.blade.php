<x-utilities.link-button colour="pink" textColour="black" href="{{ route('admin.districts') }}" class="mr-2"
                         icon="map-pin">Manage Districts
</x-utilities.link-button>

@include('admin.clusters.add')
@include('admin.clusters.edit')
@include('admin.clusters.delete')
