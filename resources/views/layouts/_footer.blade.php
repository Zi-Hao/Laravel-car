<footer class="footer">
    <div class="container">
        <p class="float-left">
            友情链接
            <br>
           @foreach($links as $link)
            <a href="{{$link -> link}}">{{$link ->link_name}}</a><br/>
            @endforeach
        </p>
        <p class="float-right">
            @foreach($bei as $beis)
                <a href="{{$beis -> link}}">{{$beis ->link_name}}</a><br/>
            @endforeach
        </p>
    </div>
</footer>