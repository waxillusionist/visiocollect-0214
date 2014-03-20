#--- Begin: jQuery anonymous wrapper

(($) ->
    'use strict'

    #--- Global vars

    $.skrollr = null

    $(window).load ->
        if $.skrollr
            $.skrollr.refresh()
        $(document).trigger 'scroll.mainNavbarFix'

    #--- Begin: domready

    $(document).ready ->

        #--- Open external links in new window

        $('a[href^="http://"],a[href^="//"]').not('[href*="'+window.location.hostname+'"]').each ->
            $(this).addClass 'external'
                .attr 'target', '_blank'

        #--- Main-NavBar Fixation

        $('.main-navbar').each ->
            $el = $(this)
            $(document).on
                'scroll.mainNavbarFix': ->
                    $el.removeClass 'fixed fix-none fix-bottom fix-top dropup'
                    s = $(document).scrollTop()
                    el_top = $el.offset().top
                    el_height = $el.outerHeight false
                    wh = $(window).height()
                    # if navbar default position is not on top of document
                    if el_top > 0
                        # if navbar position is after current visible section
                        if s <= el_top - wh + el_height
                            # fix navbar to bottom
                            $el.addClass 'fix-bottom popup'
                        # if navbar position is before current visible section
                        else if s > el_top
                            # fix navbar to top
                            $el.addClass 'fix-top'
                        # is navbar position is within current visible section
                        else
                            # do not fix navbar
                            $el.addClass 'fix-none'
                        # if navbar is near window bottom
                        if s <= el_top - wh + 80
                            # Dropup submenus
                            $el.addClass 'dropup'
                    # otherwise fix navbar to top
                    else
                        $el.addClass 'fix-top'
            .trigger 'scroll.mainNavbarFix'
            $(window).on
                'resize.mainNavbarFix': (ev) ->
                    $(document).trigger 'scroll.mainNavbarFix'

        #--- Grid Gallery

        $('.gallery-style-grid').each ->
            $gallery = $(this)
            $items = $gallery.find '.gallery-item'
            $w = $(window)
            $w.on
                'resize.gridGallery': ->
                    ww = $w.width()
                    colcount = if ww<768 then 1 else ( if ww<992 then 2 else 3 )
                    cols = []
                    $items.detach()
                    $gallery.empty()
                    $items.each ->
                        $this = $(this)
                        $img = $this.find('.gallery-icon img')
                        shortest_col = 0
                        for c in [0...colcount]
                            if !cols[c]
                                cols[c] = [ $('<ul class="col'+colcount+'"/>'), 0 ]
                                $gallery.append cols[c][0]
                            shortest_col = if shortest_col!=c and cols[c][1]<cols[shortest_col][1] then c else shortest_col
                        cols[shortest_col][0].append $('<li/>').append($this)
                        cols[shortest_col][1] += Math.round( $this.width() * parseInt($img.attr('height')) / parseInt($img.attr('width')) )
                    if $.skrollr
                        $.skrollr.refresh()
            .trigger 'resize.gridGallery'

        #--- Blog Grid

        $('.blog-grid').each ->
            $container = $(this)
            $articles = $container.find('article')
            $w = $(window)
            $w.on
                'resize.blogGrid': ->
                    ww = $w.width()
                    colcount = if ww<768 then 1 else ( if ww<992 then 2 else 3 )
                    cols = []
                    $articles.detach()
                    $container.empty()
                    $articles.each ->
                        $this = $(this)
                        shortest_col = 0
                        for c in [0...colcount]
                            if !cols[c]
                                cols[c] = [ $('<div class="col-sm-'+(12 / colcount)+'"/>'), 0 ]
                                $container.append cols[c][0]
                            shortest_col = if shortest_col!=c and cols[c][1]<cols[shortest_col][1] then c else shortest_col
                        cols[shortest_col][0].append $this
                        if $this.hasClass 'with-thumb'
                            $thumb = $this.find('.entry-thumb').hide()
                            cols[shortest_col][1] += $this.outerHeight() + Math.round( $this.width() * parseInt($thumb.attr('height')) / parseInt($thumb.attr('width')) )
                            $thumb.show()
                        else
                            cols[shortest_col][1] += $this
                        cols[shortest_col][1] += if $this.hasClass('with-thumb') then $this.height() + parseInt($this.find('.entry-thumb').attr('height')) else $this.height()
                    if $.skrollr
                        $.skrollr.refresh()
            .trigger 'resize.blogGrid'

        #--- ekko Lightbox

        $(document).on
            click: ->
                $(this).ekkoLightbox()
                return false
        , '*[data-toggle="lightbox"]'

        #--- Height fix for related containers

        $(window).on
            'resize.heightfix': ->
                $els = $('[data-heightfix^="rel"]')
                groups = {}
                xsDisplay = $(window).width()<768
                $els.each ->
                    el = $(this).css 'min-height', 'auto'
                    elh = el.height()
                    rel = el.data 'heightfix'
                    if !xsDisplay
                        if groups[rel] == undefined
                            groups[rel] =
                                maxHeight: elh
                                els: [el]
                        else
                            groups[rel].els.push el
                            if groups[rel].maxHeight < elh
                                groups[rel].maxHeight = elh
                    return
                if !xsDisplay
                    $.each groups, ->
                        group = this
                        $.each group.els, ->
                            this.css 'min-height', group.maxHeight
        .trigger 'resize.heightfix'

        #--- Fix footer to bottom if document is shorter than window

        $(window).on
            'resize.footerfix': ->
                $f = $('.global-footer')
                if $f.length==1
                    $f.removeClass 'fixed'
                    $w = $(window)
                    wh = $w.height()
                    fh = $f.removeClass('fixed').offset().top + $f.outerHeight()
                    if wh>fh
                        $f.addClass 'fixed'
        .trigger 'resize.footerfix'

        #--- Smooth scrolling to anchors

        $('.navbar-nav,.global-footer').on
            click: ->
                if location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'') and location.hostname==this.hostname
                    $target = $(this.hash)
                    $target = if $target.length then $target else $('[name=' + this.hash.slice(1) +']')
                    if $target.length
                        $('html,body').animate
                            scrollTop: $target.offset().top
                        , 500
                        return false
        , 'a[href*=#]:not([href=#])'

        #--- Parallax preparation for Skrollr

        $(window).on
            'resize.parallax': ->
                $els = $('.parallax')
                $els.each ->
                    h = $(this).height()
                    m = if $(this).data('parallax-multiplier') then parseFloat($(this).data('parallax-multiplier')) else 0.5
                    $(this).attr
                        'data-bottom-top': 'background-position: 50% '+(h*m)+'px'
                        'data-top-bottom': 'background-position: 50% -'+(h*m)+'px'
                if $.skrollr
                    $.skrollr.refresh()
        .trigger 'resize.parallax'

        #--- ScrollScale preparation for Skrollr

        if $(window).width()>=768
            $('.scrollscale').each ->
                a = 0.75
                b = 1.25
                $(this).attr
                    'data-bottom-top': '-webkit-transform: scale('+a+', '+a+');'+'-ms-transform: scale('+a+', '+a+');'+'transform: scale('+a+', '+a+');'
                    'data-top-bottom': '-webkit-transform: scale('+b+', '+b+');'+'-ms-transform: scale('+b+', '+b+');'+'transform: scale('+b+', '+b+');'

        #--- Skrollr

        $.skrollr = skrollr.init
            smoothScrolling: false
            forceHeight: false

        #--- MixItUp Spektrum

        $('.mixitup').each ->
            $mixitup = $(this)
            # if !Modernizr.touch
            $mixitup.find('.mix').each ->
                img_url = $(this).find('.img img').attr('src')
                $(this).find('figure').append([
                    $('<div class="curtain-top" style="background-image:url(\''+img_url+'\')">')[0]
                    $('<div class="curtain-bottom" style="background-image:url(\''+img_url+'\')">')[0]
                ])
            $mixitup.mixItUp
                callbacks:
                    onMixEnd: ->
                        if $.skrollr
                            $.skrollr.refresh()
            $('.mixitup-controls').find('a').on
                click: ->
                    return false

        #--- Contact form handler

        $('form.form-contact').each ->
            $form = $(this)
            $form.on
                submit: ->
                    $.ajax
                        type: 'POST'
                        url: $form.attr('action')
                        dataType: 'json'
                        data: $form.serialize()+'&cfd=1'
                        beforeSend: ->
                            $form.addClass('loading')
                                .find('.form-group.has-error').removeClass('has-error')
                                .end().find('.response,.alert').remove()
                        success: (data) ->
                            if !data.success
                                $.each data.errors, ->
                                    if this[0]=='#'
                                        $form.append '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove pull-right"></span>'+this[1]+'</div>'
                                    else
                                        $group = $form.find('#cfd_'+this[0]).closest('.form-group').addClass('has-error')
                                        $group.append $('<p class="response help-block">'+this[1]+'</p>')
                            else
                                $form.append('<div class="alert alert-success"><span class="glyphicon glyphicon-ok pull-right"></span>'+data.success+'</div>')
                                    #.find('input[type="text"],input[type="tel"],input[type="email"],textarea').val('')
                        error: (XMLHttpRequest, textStatus, errorThrown) ->
                            console.debug(textStatus)
                        complete: ->
                            $form.removeClass('loading')
                    return false
            .find('[type="submit"]').on
                click: ->
                    $(this).blur()

        #--- OnePageScroller - prepare for Bootstrap scrollspy

        $('body.page-template-custompage-onepagescroller-php').each ->
            $navas = $(this).find '.navbar-nav>li>a'
            $containers = $(this).find '[data-ops]'
            $containers.each (i) ->
                $container = $(this)
                $nava = $navas.filter('[href="'+$container.data('ops')+'"]:first')
                if $nava.length==1
                    id = $nava.text().toLowerCase().replace(/[^a-z_]/,'')
                    $nava.attr 'href', '#'+id
                    $container.attr 'id', id

        #--- GoogleMaps Integration

        $('.gmap').each ->
            $el = $(this)
            data = $(this).data()
            map =
                options:
                    mapTypeControlOptions: {}
                    overviewMapControlOptions: {}
                    panControlOptions: {}
                    rotateControlOptions: {}
                    scaleControlOptions: {}
                    streetViewControlOptions: {}
                    zoomControlOptions: {}
            $.each data, (key) ->
                value = this.toString()
                switch key
                    when 'height', 'width'
                        $el.css key, value
                    when 'address'
                        map.address = value
                    when 'center'
                        latlong = value.split(',')
                        map.options[key] = [ parseFloat(latlong[0]), parseFloat(latlong[1]) ]
                    when 'mapTypeId'
                        map.options[key] = google.maps.MapTypeId[value.toUpperCase()]
                    when 'mapTypeControlStyle'
                        map.options.mapTypeControlOptions.style = google.maps.MapTypeControlStyle[value.toUpperCase()]
                    when 'mapTypeControlPosition'
                        map.options.mapTypeControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'panControlPosition'
                        map.options.panControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'rotateControlPosition'
                        map.options.rotateControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'scaleControlPosition'
                        map.options.scaleControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'streetViewControlPosition'
                        map.options.streetViewControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'zoomControlPosition'
                        map.options.streetViewControlOptions.position = google.maps.ControlPosition[value.toUpperCase()]
                    when 'zoomControlStyle'
                        map.options.zoomControlOptions.style = google.maps.ZoomControlStyle[value.toUpperCase()]
                    when 'overviewMapControlOpened'
                        map.options.overviewMapControlOptions.opened = value == 'true'
                    when 'backgroundColor'
                        map.options[key] = value
                    when 'heading', 'zoom', 'maxZoom', 'minZoom', 'tilt'
                        map.options[key] = parseInt value
                    when 'disableDefaultUI', 'disableDoubleClickZoom', 'draggable', 'draggableCursor', 'draggingCursor', 'keyboardShortcuts', 'mapMaker', 'mapTypeControl', 'noClear', 'overviewMapControl', 'panControl', 'rotateControl', 'scaleControl', 'scrollwheel', 'streetViewControl', 'zoomControl'
                        map.options[key] = value == 'true'
                return
            $el.gmap3
                map: map

        #--- GMap Anfahrt

        $('.map-anfahrt').each ->
            address = $(this).data('address')
            zoom = $(this).data('zoom')
            $(this).gmap3
                map:
                    options:
                        styles: [
                            featureType: 'all'
                            elementType: 'all'
                            stylers: [
                                { hue: '#00B4FF' }
                                { saturation: -25 }
                                { lightness: -5 }
                            ]
                        ]
                marker:
                    values:[
                        address: address
                        data: '<p style="font-weight:400;margin:.2em;letter-spacing:.1em;font-family:Gravia,sans-serif;font-size:16px;color:#000;white-space:nowrap;display:block;">'+
                            'Visiocollect Areal<br>'+
                            '<a style="color:#000;text-decoration:none;" href="http://maps.google.com/maps?'+
                            'daddr='+encodeURIComponent(address)+
                            '&z='+zoom+
                            '" target="_blank">'+
                            '&#x25b6; '+
                            'ROUTE BERECHNEN</a></p>'
                        options:
                            icon: 'http://visiocollect.com/wp-content/uploads/2014/01/marker.png'
                    ]
                    options:
                        draggable: false
                    events:
                        click: (marker, event, context) ->
                            map = $(this).gmap3('get')
                            infowindow = $(this).gmap3
                                get:
                                    name: 'infowindow'
                            if infowindow
                                infowindow.open map, marker
                                infowindow.setContent context.data
                            else
                                $(this).gmap3
                                    infowindow:
                                        anchor: marker
                                        options:
                                            content: context.data

        #--- End: domready

        return

    #--- End: jQuery anonymous wrapper

    return

)(jQuery)
