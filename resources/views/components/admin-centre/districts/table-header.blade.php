<x-utilities.link-button colour="pink" textColour="black" href="{{ route('admin-centre.clusters') }}" class="mr-2"
                         icon="map">Manage Clusters
</x-utilities.link-button>

@include('admin-centre.districts.add')
@include('admin-centre.districts.edit')
@include('admin-centre.districts.delete')
