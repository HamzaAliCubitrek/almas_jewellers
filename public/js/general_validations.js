        /*
        Validation Rule

        jsfiddle Link https://jsfiddle.net/emkey08/tvx5e7q3
    */


    (function($) {

        $.fn.inputFilter = function(inputFilter)
        {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function()
            {
                if (inputFilter(this.value))
                {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                }
                else if (this.hasOwnProperty("oldValue"))
                {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
                else
                {
                    this.value = "";
                }
            });
        };

    }(jQuery));

    // Integer

    $("#intTextBox").inputFilter(function(value)
    {
        return /^-?\d*$/.test(value);
    });

    // Integer >= 0

    $(".uintTextBox").inputFilter(function(value)
    {
        return /^\d*$/.test(value);
    });

    // Integer >= 0 and <= 99

    $(".intLimitTextBox").inputFilter(function(value)
    {
        return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99);
    });

    // Float (use . or , as decimal separator)  2121.2121212 OR 2134234,21212

    $("#floatTextBox").inputFilter(function(value)
    {
        return /^-?\d*[.,]?\d*$/.test(value);
    });

    // Currency (at most two decimal places) e.g. 21212.22 OR 11212,21

    $("#currencyTextBox").inputFilter(function(value)
    {
        return /^-?\d*[.,]?\d{0,2}$/.test(value);
    });

    // A-Z = small + capital

    $("#latinTextBox").inputFilter(function(value)
    {
        return /^[a-z]*$/i.test(value);
    });
