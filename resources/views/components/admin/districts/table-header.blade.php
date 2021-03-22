<x-utilities.link-button colour="pink" textColour="black" href="{{ route('admin.clusters') }}" class="mr-2"
                         icon="map">Manage Clusters
</x-utilities.link-button>

@include('admin.districts.add')
@include('admin.districts.edit')
@include('admin.districts.delete')
