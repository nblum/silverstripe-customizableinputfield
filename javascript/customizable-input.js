(function ($) {
    $.entwine('ss', function ($) {
        $.entwine('customizableinput', function ($) {
            var me = this;

            $('.customizable-input input[data-part]').entwine({
                onmatch: function () {
                    var id = '#' + $(this).parents('.customizable-input').first().attr('id');

                    $(this).on('keydown', function (e) {
                        me.handleKeysDown(id, $(this), e.keyCode);
                    });

                    $(this).on('keyup', function (e) {
                        me.handleKeysUp(id, $(this), e.keyCode);
                    });

                    $(this).on('change', function () {
                        $(this).val(me.cleanUpString($(this).val(), $(this).data('allowedsigns')));
                        me.updateValue(id);
                    });
                }
            });

            $('.customizable-input select[data-part]').entwine({
                onmatch: function () {
                    var id = '#' + $(this).parents('.customizable-input').first().attr('id');

                    $(this).on('change', function () {

                        me.updateValue(id);
                    });
                }
            });

            /**
             * updates the value of the (hidden) value field
             * @param id
             */
            this.updateValue = function (id) {
                var result = [],
                    $item;

                $(id + ' [data-part]').each(function (index, item) {
                    $item = $(item);
                    $before = $item.parent().prev();
                    $after = $item.parent().next();

                    result[index] = {
                        name: $item.attr('name'),
                        val: $item.val(),
                        before: $before.attr('data-val'),
                        after: $after.attr('data-val'),
                        whitespaces: $item.attr('data-whitespaces')
                    }
                });

                $(id + ' input[data-value]').val(JSON.stringify(result));
            };

            /**
             * handles all keys on keydown event
             * @param id
             * @param $input
             * @param code
             */
            this.handleKeysDown = function (id, $input, code) {
                var part = parseInt($input.attr('data-part')),
                    val = $input.val(),
                    max = parseInt($input.attr('maxlength')),
                    $prev = $(id + ' input[data-part="' + (part - 1) + '"]'),
                    $next = $(id + ' input[data-part="' + (part + 1) + '"]');

                //console.log(code);

                //backspace
                if (code === 8 && !!$prev) {
                    if (me.getCursorPosition($input[0]) === 0) {
                        $prev.focus();
                    }
                    return;
                }
            };

            /**
             * handles all keys on keyup event
             * @param id
             * @param $input
             * @param code
             */
            this.handleKeysUp = function (id, $input, code) {
                var part = parseInt($input.attr('data-part')),
                    val = $input.val(),
                    allowedSigns = $input.attr('data-allowedsigns'),
                    max = parseInt($input.attr('maxlength')),
                    $prev = $(id + ' input[data-part="' + (part - 1) + '"]'),
                    $next = $(id + ' input[data-part="' + (part + 1) + '"]');

                if (code === 8) {
                    return;
                }

                val = this.cleanUpString(val, allowedSigns);
                $input.val(val);

                //left
                if (code === 37 && !!$prev) {
                    if (me.getCursorPosition($input[0]) === 0) {
                        $prev.focus();
                    }
                    return;
                }

                //right
                if (code === 39 && !!$next) {
                    if (me.getCursorPosition($input[0]) === val.length) {
                        $next.focus();
                    }
                    return;
                }

                //this.autoPrevField($prev, val);
                this.autoNextField($next, max, val);
            };

            /**
             * removes unwanted signs
             */
            this.cleanUpString = function (val, allowedSigns) {
                var regexp = new RegExp(allowedSigns, 'gi');
                return val.replace(regexp, '');
            };

            /**
             * focus the previous input field if cursor is on the first position
             * @param $prev
             * @param val
             */
            this.autoPrevField = function ($prev, val) {
                if (!$prev) {
                    return;
                }

                if (val.length > 0) {
                    return;
                }

                $prev.focus();
            };

            /**
             * focus to the next input field if cursor is at the end
             * @param $next
             * @param max
             * @param val
             */
            this.autoNextField = function ($next, max, val) {
                if (!$next) {
                    return;
                }

                if (isNaN(max)) {
                    return;
                }

                if (val.length < max) {
                    return;
                }

                $next.focus();
            };

            /**
             * returns the cursor position for the given input element
             * @param input
             * @returns {*}
             */
            this.getCursorPosition = function (input) {
                if (!input) {
                    return;
                }

                if ('selectionStart' in input) {
                    return input.selectionStart;
                }

                if (!document.selection) {
                    return;
                }

                input.focus();
                var sel = document.selection.createRange();
                var selLen = document.selection.createRange().text.length;
                sel.moveStart('character', -input.value.length);
                return sel.text.length - selLen;
            };

        }); // customizableinput namespace
    }); // ss namespace
}(jQuery));