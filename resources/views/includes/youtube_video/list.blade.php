@forelse ($youtube as $youtu)
    <div class="d-none d-md-block">
        <iframe width="100%" height="200" src="https://www.youtube.com/embed/{{ getVideoId($youtu['url']) }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="d-block d-md-none">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{ getVideoId($youtu['url']) }}?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
@empty
    
@endforelse