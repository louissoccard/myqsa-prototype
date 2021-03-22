<x-utilities.link-button colour="pink" textColour="black" href="{{ route('admin-centre.districts') }}" class="mr-2"
                         icon="map-pin">Manage Districts
</x-utilities.link-button>

@include('admin-centre.clusters.add')
@include('admin-centre.clusters.edit')
@include('admin-centre.clusters.delete')
