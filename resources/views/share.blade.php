<div class="row share">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $link }}"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="{{asset('img/facebook.jpeg')}}" alt="facebook">
    </a>
    <a href="http://twitter.com/share?&url={{ $link }}&text={{ $text }}"
       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="{{asset('img/twitter.jpeg')}}" alt="twitter">
    </a>
</div>
<div class="row">
    <div class="col">
        <a href="{{ url('members') }}" class="float-right">All members ({{ $countMembers }})</a>
    </div>
</div>
