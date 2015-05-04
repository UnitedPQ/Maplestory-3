class vivoSlide
    constructor: (@obj, o) ->
        @o = $.extend
            autoStart: true
            slideTime: 300
            changeTime: 2500
            overStop: true
            listObj: '.slide-list'
            thumbObj: '.slide-thumb'
            nextBtn: '.slide-next'
            prevBtn: '.slide-prev'
        , o || {}

        @listObj = @obj.find @o.listObj
        @thumbObj = @obj.find @o.thumbObj
        @nextBtn = @obj.find @o.nextBtn
        @prevBtn = @obj.find @o.prevBtn

        @size = @listObj.children().size()
        @width = @listObj.children().width()
        @height = @listObj.children().height()
        @nowIndex = 1
        @index = 1
        @autoRun = null

    slideIt: (idx) ->
        if idx == 'next'
            nextIndex = @nowIndex + 1
        else if idx == 'prev'
            nextIndex = @nowIndex - 1
        else
            nextIndex = if idx >= 1 and idx <= @size then idx else @nowIndex

        @listObj.animate
            'margin-left': -1 * @width * nextIndex + 'px'
        , @o.slideTime, =>
            if nextIndex == 0
                nextIndex = @size
            else if nextIndex == @size + 1
                nextIndex = 1

            @nowIndex = nextIndex
            @listObj.css
                'margin-left': -1 * @width * @nowIndex + 'px'
            @thumbObj.children().removeClass('active').eq(@nowIndex - 1).addClass('active')

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

        if @thumbObj
            that = @
            @thumbObj.children().click ->
                index = $(this).index()
                that.slideIt index + 1

        if @o.autoStart
            @autoRun = setInterval =>
                @slideIt 'next'
            , @o.changeTime - parseInt(300 * Math.random())

            if @o.overStop
                @obj.hover =>
                    clearInterval @autoRun
                , =>
                    @autoRun = setInterval =>
                        @slideIt 'next'
                    , @o.changeTime - parseInt(300 * Math.random())

        return @

$.fn.slide = (o) ->
    this.each ->
        slideObj = new vivoSlide $(this), o
        slideObj.init()