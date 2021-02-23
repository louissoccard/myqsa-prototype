@props(['class' => '', 'size' => 24])
{{ $icons->get($slot, array('class' => $class, 'width' => $size, 'height' => $size)) }}
