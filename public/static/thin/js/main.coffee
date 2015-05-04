class Slide
    constructor: (@obj) ->
        @listObj = @obj.find '.slide-list ul'
        @prevBtn = @obj.find '.slide-left'
        @nextBtn = @obj.find '.slide-right'

        @size = @listObj.children().size()
        @width = @listObj.children().width()
        @height = @listObj.children().height()

        @slideTime = 300
        @nowIndex = 1
        @index = 1
        @valueName = @obj.data 'name'
        @valueObj = @obj.find "input[name=#{@valueName}]"

    slideIt: (idx) ->
        if idx == 'next'
            nextIndex = @nowIndex + 1
        else if idx == 'prev'
            nextIndex = @nowIndex - 1
        else
            nextIndex = if idx >= 1 and idx <= @size then idx else @nowIndex

        @listObj.animate
            'margin-left': -1 * @width * nextIndex + 'px'
        , @slideTime, =>
            if nextIndex == 0
                nextIndex = @size
            else if nextIndex == @size + 1
                nextIndex = 1

            @nowIndex = nextIndex
            @listObj.css
                'margin-left': -1 * @width * @nowIndex + 'px'

            #currentObj = @listObj.children().eq @nowIndex
            #value = currentObj.data 'value'
            #@valueObj.val value

    init: ->
        firstItem = @listObj.children().first().clone()
        lastItem = @listObj.children().last().clone()
        @listObj.append(firstItem).prepend(lastItem)

        @listObj.width(@width * (@size + 2)).css
            'margin-left': -1 * @width * @nowIndex + 'px'

        @listObj.children().width(@width).height(@height)

        if @nextBtn
            @nextBtn.click =>
                @slideIt('next')
                false

        if @prevBtn
            @prevBtn.click =>
                @slideIt('prev')
                false

        return @

$.fn.slide = ->
    this.each ->
        slideObj = new Slide $(this)
        slideObj.init()
        $(this).data 'slide', slideObj

class Draw
    constructor: (@el) ->
        @current = 0
        @width = @el.width()
        @height = @el.height()
        @timer = null
        @slideTime = 400
        @size = 4

    run: (stop, callback, step = 0) ->
        stop = stop % @size if stop > @size
        @current += 1
        if @current > @size
            @current = 1
        @el.css
            'background-position': "-#{@width * @current}px, 0px"

        if step < 3.3 or @current != stop
            setTimeout =>
                step += 0.08
                @run(stop, callback, step)
            , @slideTime - (@slideTime - 50) * Math.sin(step)
        else
            if typeof callback == 'function'
                callback.call(this)

$.fn.draw = (stop, callback) ->
    this.each ->
        draw = $(this).data 'draw'
        if not draw
            draw = new Draw $(this)
            $(this).data 'draw', draw
        draw.run stop, callback

$.alert = (message, button = [], title = '小V温馨提示...') ->
    d = dialog
        width: 380
        title: title
        content: message
        okValue: '关闭'
        ok: ->
        button: button
    d.showModal()

$(document).ready ->
    if $.support.pjax
        $(document).pjax 'a[data-pjax]', '#pjax-container'
        $(document).on 'pjax:start', ->
            NProgress.start()
        .on 'pjax:end', ->
            NProgress.done()