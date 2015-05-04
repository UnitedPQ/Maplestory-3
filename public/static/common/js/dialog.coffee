class Dialog
    constructor: (options) ->
        defaults =
            id: 'dialog'
            title: null
            content: null
            buttons: null
            width: '90%'
            height: 'auto'
            position: 'center center'
            padding: 0
            open: true

        @options = $.extend false, {}, defaults, options
        @version = '1.0.0'

        if $.dialog.get(@options.id)
            $.dialog.get(@options.id).close()

        @init()

        if @options.open
            @open()

    init: ->
        me = this

        overlay = $('<div class="dialog-overlay"></div>')
        overlay.attr 'id', @options.id
        overlay.css
            'display': 'none'
            'position': 'fixed'
            'top': '0px'
            'left': '0px'
            'width': '100%'
            'height': '100%'
            'background-color': 'rgba(0,0,0,0.8)'
            'z-index': 999

        if not @options.content
            overlay.addClass 'dialog-loading'
        else
            dialog = $('<div class="dialog"></div>')
            if @options.title
                title = $('<div class="dialog-title"><strong>'+@options.title+'</strong><a href="#" class="dialog-close">x</a></div>')
                title.appendTo dialog

            if @options.content
                content = $('<div class="dialog-content">'+@options.content+'</div>')
                content.appendTo dialog

            dialog.css
                'width': @options.width
                'height': @options.height
            .appendTo overlay

        overlay.appendTo $('body')
        overlay.find('.dialog-close').click (e) ->
            e.preventDefault()
            me.close()

        @dialog = overlay

    getId: ->
        @options.id

    close: ->
        @dialog.remove()

    open: ->
        @dialog.show()

        winW = $(window).width()
        winH = $(window).height()
        dW = @dialog.find('.dialog').width()
        dH = @dialog.find('.dialog').height()
        @dialog.find('.dialog').css
            'position': 'fixed'
            'left': (winW - dW) / 2 + 'px'
            'top': (winH - dH) / 2 + 'px'


$.dialog = {windows: {}}
$.dialog.closeAll = ->
    $('body').find('.dialog-overlay').remove()

$.dialog.get = (id) ->
    $.dialog.windows[id]

$.dialog.set = (id, dialog) ->
    $.dialog.windows[id] = dialog

$.dialog.loading = (act) ->
    if act == 'close'
        $.dialog.get('loading').close()
    else
        dialog = new Dialog 'id': 'loading'
        $.dialog.set 'loading', dialog

$.fn.dialog = (options) ->
    dialogId = $(this).parents('.dialog-overlay').attr('id')
    dialog = $.dialog.get dialogId

    if options == 'close'
        dialog.close()
    else if options == 'open'
        dialog.open()
    else
        options = {} if not options
        options.content = $(this).get(0).outerHTML
        dialog = new Dialog options

        $.dialog.set dialog.getId(), dialog

    return dialog

$(document).on 'click', 'a[data-trigger=dialog]', (e) ->
    e.preventDefault()
    me = $(this)

    if not me.data 'requesting'
        me.data 'requesting', true
        data = me.data()
        method = if data['method'] then data['method'] else 'get'
        dataType = if data['type'] then data['type'] else 'html'

        dialogTitle = if data['title'] then data['title'] else null
        dialogWidth = if data['width'] then data['width'] else 'auto'
        dialogHeight = if data['height'] then data['height'] else 'auto'

        $.ajax
            url: data['url']
            type: method
            dataType: dataType
            data: data['data']
            beforeSend: ->
                me.data 'requesting', true
                me.trigger 'ajax:before'
            error: ->
                me.removeData 'requesting'
            success: (response) ->
                me.removeData 'requesting'
                html = if dataType == 'json' then response.html else response
                $(html).dialog
                    title: dialogTitle
                    width: dialogWidth
                    height: dialogHeight
.on 'submit', 'form[data-trigger=dialog]', (e) ->
    e.preventDefault()
    me = $(this)

    if not me.data 'requesting'
        me.data 'requesting', true
        data = me.data()
        dataType = if data['type'] then data['type'] else 'html'

        dialogTitle = if data['title'] then data['title'] else null
        dialogWidth = if data['width'] then data['width'] else 'auto'
        dialogHeight = if data['height'] then data['height'] else 'auto'

        $.ajax
            url: me.attr 'action'
            type: me.attr 'method'
            dataType: dataType
            data: me.serialize()
            beforeSend: ->
                me.data 'requesting', true
                me.trigger 'ajax:before'
            error: ->
                me.removeData 'requesting'
            success: (response) ->
                me.removeData 'requesting'
                html = if dataType == 'json' then response.html else response
                $(html).dialog
                    title: dialogTitle
                    width: dialogWidth
                    height: dialogHeight