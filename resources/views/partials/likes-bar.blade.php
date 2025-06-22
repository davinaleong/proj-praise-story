<!-- Display likes or visual bar -->
<div class="h-2 w-full flex rounded overflow-hidden mb-4">
    @php
        $green = $testimony->likes->where('type', 'green')->count();
        $yellow = $testimony->likes->where('type', 'yellow')->count();
        $red = $testimony->likes->where('type', 'red')->count();
        $total = $green + $yellow + $red;

        $gp = $total ? ($green / $total) * 100 : 0;
        $yp = $total ? ($yellow / $total) * 100 : 0;
        $rp = $total ? ($red / $total) * 100 : 0;
    @endphp
    <div class="bg-green-500" style="width: {{ $gp }}%"></div>
    <div class="bg-yellow-400" style="width: {{ $yp }}%"></div>
    <div class="bg-red-500" style="width: {{ $rp }}%"></div>
</div>
