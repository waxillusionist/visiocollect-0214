#--- Begin: jQuery anonymous wrapper

(($) ->
    'use strict'

    $.fn.loadOnScroll = (_options)->
        this.each ->
            historySupport = !!(window.history && history.replaceState)
            options = $.extend
                items: 'article'
                nextLink: '.pagination .next'
                complete: $.noop
                hide: '.pagination'
                indicator: '.loadonscroll-indicator'
            , _options
            $window = $(window)
            $document = $(document)
            $title = $('title')
            $target = null
            url = null
            ajaxRunning = false

            loadContentOnScroll = ->
                if url and $document.scrollTop() >= ( $target.offset().top + $target.outerHeight() - $window.height() )
                    $.ajax
                        url: url
                        type: 'GET'
                        dataType: 'html'
                        data: ''
                        beforeSend: (xhr, settings) ->
                            $document.off 'scroll.loadOnScroll'
                            $target.addClass 'loading'
                        success: (data, status, xhr) ->
                            $data = $(data)
                            $content = $data.find(options.items)
                            # if historySupport
                            #     history.replaceState({}, $title.html(), url)
                            url = $data.find(options.nextLink).attr('href')
                            url = if url!=undefined then url.split('?')[0] else url
                            if( $content.length>0 )
                                $(options.items).filter(':last').after($content)
                        error: (xhr, status, err) ->
                            # console.debug status.toUpperCase()+': '+err
                        complete: (xhr, status) ->
                            $target.removeClass 'loading'
                            bindLoadOnScroll()
                            options.complete()
                            loadContentOnScroll()

            bindLoadOnScroll = ->
                if url
                    $document.on
                        'scroll.loadOnScroll': loadContentOnScroll

            $target = $(this)
            url = $(options.nextLink).attr('href')

            bindLoadOnScroll()
            loadContentOnScroll()

            if options.hide.length>0 then $(options.hide).hide()

    return

)(jQuery)
