/*----------------------------------------

----------------------------------------*/
(function () {

    'use strict';

    /**
     * Class WorkingPlan
     *
     * Contains the working plan functionality. The working plan DOM elements must be same
     * in every page this class is used.
     *
     * @class WorkingPlan
     */
    var WorkingPlan = function () {
        /**
         * This flag is used when trying to cancel row editing. It is
         * true only whenever the user presses the cancel button.
         *
         * @type {Boolean}
         */
        this.enableCancel = false;

        /**
         * This flag determines whether the jeditables are allowed to submit. It is
         * true only whenever the user presses the save button.
         *
         * @type {Boolean}
         */
        this.enableSubmit = false;
    };

    /**
     * Setup the dom elements of a given working plan.
     *
     * @param {Object} workingPlan Contains the working hours and breaks for each day of the week.
     */
    WorkingPlan.prototype.setup = function (workingPlan) {
        $.each(workingPlan, function (index, workingDay) {
            if (workingDay != null) {
                $('#' + index).prop('checked', true);
                $('#' + index + '-start').val(workingDay.start);
                $('#' + index + '-end').val(workingDay.end);

                // Add the day's breaks on the breaks table.
                $.each(workingDay.breaks, function (i, brk) {
                    var day = this.convertValueToDay(index);

                    var tr =
                        '<tr>' +
                        '<td class="break-day editable">' + day + '</td>' +
                        '<td class="break-start editable">' + brk.start + '</td>' +
                        '<td class="break-end editable">' + brk.end + '</td>' +
                        '<td>' +
                        '<button type="button" class="btn btn-default btn-sm edit-break" title="edit">' +
                        '<i class="la la-edit"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-default btn-sm delete-break" title="delete">' +
                        '<i class="la la-trash"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-default btn-sm save-break hidden" title="save">' +
                        '<i class="la la-check-square"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-default btn-sm cancel-break hidden" title="cancel">' +
                        '<i class="la la-close"></i>' +
                        '</button>' +
                        '</td>' +
                        '</tr>';
                    $('.breaks tbody').append(tr);
                }.bind(this));
            } else {
                $('#' + index).prop('checked', false);
                $('#' + index + '-start').prop('disabled', true);
                $('#' + index + '-end').prop('disabled', true);
            }
        }.bind(this));

        if(workingPlan != null){
            $.each(workingPlan.daysoff, function (i, date) {
                
                var tr =
                    '<tr>' +
                    '<td class="dayoff-date editable">'+date+'</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-default btn-sm edit-dayoff" title="edit">' +
                    '<i class="la la-edit"></i>' +
                    '</button>' +
                    '<button type="button" class="btn btn-default btn-sm delete-dayoff" title="delete">' +
                    '<i class="la la-trash"></i>' +
                    '</button>' +
                    '<button type="button" class="btn btn-default btn-sm save-dayoff hidden" title="save">' +
                    '<i class="la la-check-square"></i>' +
                    '</button>' +
                    '<button type="button" class="btn btn-default btn-sm cancel-dayoff hidden" title="cancel">' +
                    '<i class="la la-close"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>';
                $('.daysoff').prepend(tr);
            }.bind(this));
        }

        // Make daysoff cells editable.
        this.editableDayoffDate($('.dayoff-date'));
        // Make break cells editable.
        this.editableBreakDay($('.breaks .break-day'));
        this.editableBreakTime($('.breaks').find('.break-start, .break-end'));
    };

    /**
     * Enable editable break day.
     *
     * This method makes editable the break day cells.
     *
     * @param {Object} $selector The jquery selector ready for use.
     */
    WorkingPlan.prototype.editableBreakDay = function ($selector) {
        var weekDays = {};
        weekDays['Sunday'] = 'Sunday';
        weekDays['Monday'] = 'Monday';
        weekDays['Tuesday'] = 'Tuesday';
        weekDays['Wednesday'] = 'Wednesday';
        weekDays['Thursday'] = 'Thursday';
        weekDays['Friday'] = 'Friday';
        weekDays['Saturday'] = 'Saturday';

        $selector.editable(function (value, settings) {
            return value;
        }, {
            type: 'select',
            data: weekDays,
            event: 'edit',
            height: '30px',
            submit: '<button type="button" class="hidden submit-editable">Submit</button>',
            cancel: '<button type="button" class="hidden cancel-editable">Cancel</button>',
            onblur: 'ignore',
            onreset: function (settings, td) {
                if (!this.enableCancel) {
                    return false; // disable ESC button
                }
            }.bind(this),
            onsubmit: function (settings, td) {
                if (!this.enableSubmit) {
                    return false; // disable Enter button
                }
            }.bind(this)
        });
    };

    /**
     * Enable editable break time.
     *
     * This method makes editable the break time cells.
     *
     * @param {Object} $selector The jquery selector ready for use.
     */
    WorkingPlan.prototype.editableBreakTime = function ($selector) {
        $selector.editable(function (value, settings) {
            // Do not return the value because the user needs to press the "Save" button.
            return value;
        }, {
            event: 'edit',
            height: '30px',
            submit: '<button type="button" class="hidden submit-editable">Submit</button>',
            cancel: '<button type="button" class="hidden cancel-editable">Cancel</button>',
            onblur: 'ignore',
            onreset: function (settings, td) {
                if (!this.enableCancel) {
                    return false; // disable ESC button
                }
            }.bind(this),
            onsubmit: function (settings, td) {
                if (!this.enableSubmit) {
                    return false; // disable Enter button
                }
            }.bind(this)
        });
    };

    /**
     * Enable editable day off.
     *
     * This method makes editable the dayoff cells.
     *
     * @param {Object} $selector The jquery selector ready for use.
     */
    WorkingPlan.prototype.editableDayoffDate = function ($selector) {
        $selector.editable(function (value, settings) {
            // Do not return the value because the user needs to press the "Save" button.
            return value;
        }, {
            event: 'edit',
            height: '30px',
            submit: '<button type="button" class="hidden submit-editable">Submit</button>',
            cancel: '<button type="button" class="hidden cancel-editable">Cancel</button>',
            onblur: 'ignore',
            onreset: function (settings, td) {
                if (!this.enableCancel) {
                    return false; // disable ESC button
                }
            }.bind(this),
            onsubmit: function (settings, td) {
                if (!this.enableSubmit) {
                    return false; // disable Enter button
                }
            }.bind(this)
        });
    };

    /**
     * Binds the event handlers for the working plan dom elements.
     */
    WorkingPlan.prototype.bindEventHandlers = function () {
        /**
         * Event: Day Checkbox "Click"
         *
         * Enable or disable the time selection for each day.
         */
        $('.working-plan input:checkbox').click(function () {
            var id = $(this).attr('id');

            if ($(this).prop('checked') == true) {
                $('#' + id + '-start').prop('disabled', false).val('9:00 AM');
                $('#' + id + '-end').prop('disabled', false).val('6:00 PM');
            } else {
                $('#' + id + '-start').prop('disabled', true).val('');
                $('#' + id + '-end').prop('disabled', true).val('');
            }
        });

        /**
         * Event: Add Break Button "Click"
         *
         * A new row is added on the table and the user can enter the new break
         * data. After that he can either press the save or cancel button.
         */
        $('.add-break').click(function () {
            var tr =
                '<tr>' +
                '<td class="break-day editable">Sunday</td>' +
                '<td class="break-start editable">9:00</td>' +
                '<td class="break-end editable">10:00</td>' +
                '<td>' +
                '<button type="button" class="btn btn-default btn-sm edit-break" title="edit">' +
                '<i class="la la-edit"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm delete-break" title="delete">' +
                '<i class="la la-trash"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm save-break hidden" title="save">' +
                '<i class="la la-check-square"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm cancel-break hidden" title="cancel">' +
                '<i class="la la-close"></i>' +
                '</button>' +
                '</td>' +
                '</tr>';
            $('.breaks').prepend(tr);

            // Bind editable and event handlers.
            tr = $('.breaks tr')[1];
            this.editableBreakDay($(tr).find('.break-day'));
            this.editableBreakTime($(tr).find('.break-start, .break-end'));
            $(tr).find('.edit-break').trigger('click');
            $('.add-break').prop('disabled', true);
        }.bind(this));

        /**
         * Event: Edit Break Button "Click"
         *
         * Enables the row editing for the "Breaks" table rows.
         */
        $(document).on('click', '.edit-break', function () {
            // Reset previous editable tds
            var $previousEdt = $(this).closest('table').find('.editable').get();
            $.each($previousEdt, function (index, editable) {
                if (editable.reset !== undefined) {
                    editable.reset();
                }
            });

            // Make all cells in current row editable.
            $(this).parent().parent().children().trigger('edit');
            $(this).parent().parent().find('.break-start input, .break-end input').pickatime({
                min: [9,0],
                max: [18,0],
                format: 'HH:i',
            });
            $(this).parent().parent().find('.break-day select').focus();

            // Show save - cancel buttons.
            $(this).closest('table').find('.edit-break, .delete-break').addClass('hidden');
            $(this).parent().find('.save-break, .cancel-break').removeClass('hidden');
            $(this).closest('tr').find('select,input:text').addClass('form-control input-sm')

            $('.add-break').prop('disabled', true);
        });

        /**
         * Event: Delete Break Button "Click"
         *
         * Removes the current line from the "Breaks" table.
         */
        $(document).on('click', '.delete-break', function () {
            $(this).parent().parent().remove();
        });

        /**
         * Event: Cancel Break Button "Click"
         *
         * Bring the ".breaks" table back to its initial state.
         *
         * @param {jQuery.Event} e
         */
        $(document).on('click', '.cancel-break', function (e) {
            var element = e.target;
            var $modifiedRow = $(element).closest('tr');
            this.enableCancel = true;
            $modifiedRow.find('.cancel-editable').trigger('click');
            this.enableCancel = false;

            $(element).closest('table').find('.edit-break, .delete-break').removeClass('hidden');
            $modifiedRow.find('.save-break, .cancel-break').addClass('hidden');
            $('.add-break').prop('disabled', false);
        }.bind(this));

        /**
         * Event: Save Break Button "Click"
         *
         * Save the editable values and restore the table to its initial state.
         *
         * @param {jQuery.Event} e
         */
        $(document).on('click', '.save-break', function (e) {
            // Break's start time must always be prior to break's end.
            var element = e.target,
                $modifiedRow = $(element).closest('tr'),
                start = Date.parse($modifiedRow.find('.break-start input').val()),
                end = Date.parse($modifiedRow.find('.break-end input').val());

            if (start > end) {
                $modifiedRow.find('.break-end input').val(start.addHours(1).toString('h:mm tt'));
            }

            this.enableSubmit = true;
            $modifiedRow.find('.editable .submit-editable').trigger('click');
            this.enableSubmit = false;

            $modifiedRow.find('.save-break, .cancel-break').addClass('hidden');
            $(element).closest('table').find('.edit-break, .delete-break').removeClass('hidden');
            $('.add-break').prop('disabled', false);
        }.bind(this));

        /**
         * Event: Add Day off Button "Click"
         *
         * A new row is added on the table and the user can enter the new day off
         * data. After that he can either press the save or cancel button.
         */
        $('.add-dayoff').click(function () {
            var tr =
                '<tr>' +
                '<td class="dayoff-date editable"></td>' +
                '<td>' +
                '<button type="button" class="btn btn-default btn-sm edit-dayoff" title="edit">' +
                '<i class="la la-edit"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm delete-dayoff" title="delete">' +
                '<i class="la la-trash"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm save-dayoff hidden" title="save">' +
                '<i class="la la-check-square"></i>' +
                '</button>' +
                '<button type="button" class="btn btn-default btn-sm cancel-dayoff hidden" title="cancel">' +
                '<i class="la la-close"></i>' +
                '</button>' +
                '</td>' +
                '</tr>';
            $('.daysoff').prepend(tr);

            // Bind editable and event handlers.
            tr = $('.daysoff tr')[1];
            this.editableDayoffDate($(tr).find('.dayoff-date'));
            $(tr).find('.edit-dayoff').trigger('click');
            $('.add-dayoff').prop('disabled', true);
        }.bind(this));

        /**
         * Event: Edit Dayoff Button "Click"
         *
         * Enables the row editing for the "Dayoff" table rows.
         */
        $(document).on('click', '.edit-dayoff', function () {
            // Reset previous editable tds
            var $previousEdt = $(this).closest('table').find('.editable').get();
            $.each($previousEdt, function (index, editable) {
                if (editable.reset !== undefined) {
                    editable.reset();
                }
            });

            // Make all cells in current row editable.
            $(this).parent().parent().children().trigger('edit');
            $(this).parent().parent().find('.dayoff-date input').pickadate({
                format: 'yyyy-mm-d'
            });

            // Show save - cancel buttons.
            $(this).closest('table').find('.edit-dayoff, .delete-dayoff').addClass('hidden');
            $(this).parent().find('.save-dayoff, .cancel-dayoff').removeClass('hidden');
            $(this).closest('tr').find('input:text').addClass('form-control input-sm')

            $('.add-dayoff').prop('disabled', true);
        });

        /**
         * Event: Save Dayoff Button "Click"
         *
         * Save the editable values and restore the table to its initial state.
         *
         * @param {jQuery.Event} e
         */
        $(document).on('click', '.save-dayoff', function (e) {
            // Break's start time must always be prior to break's end.
            var element = e.target,
            $modifiedRow = $(element).closest('tr');                

            this.enableSubmit = true;
            $modifiedRow.find('.editable .submit-editable').trigger('click');
            this.enableSubmit = false;

            $modifiedRow.find('.save-dayoff, .cancel-dayoff').addClass('hidden');
            $(element).closest('table').find('.edit-dayoff, .delete-dayoff').removeClass('hidden');
            $('.add-dayoff').prop('disabled', false);
        }.bind(this));

         /**
         * Event: Delete Dayoff Button "Click"
         *
         * Removes the current line from the "Breaks" table.
         */
        $(document).on('click', '.delete-dayoff', function () {
            $(this).parent().parent().remove();
        });

        /**
         * Event: Cancel Dayoff Button "Click"
         *
         * Bring the ".breaks" table back to its initial state.
         *
         * @param {jQuery.Event} e
         */
        $(document).on('click', '.cancel-dayoff', function (e) {
            var element = e.target;
            var $modifiedRow = $(element).closest('tr');
            this.enableCancel = true;
            $modifiedRow.find('.cancel-editable').trigger('click');
            this.enableCancel = false;

            $(element).closest('table').find('.edit-dayoff, .delete-dayoff').removeClass('hidden');
            $modifiedRow.find('.save-dayoff, .cancel-dayoff').addClass('hidden');
            $('.add-dayoff').prop('disabled', false);
        }.bind(this));
    };

    /**
     * Get the working plan settings.
     *
     * @return {Object} Returns the working plan settings object.
     */
    WorkingPlan.prototype.get = function () {
        var workingPlan = {"daysoff":[]};
        $('.working-plan input:checkbox').each(function (index, checkbox) {
            var id = $(checkbox).attr('id');
            if ($(checkbox).prop('checked') == true) {
                workingPlan[id] = {
                    start: $('#' + id + '-start').val(),
                    end: $('#' + id + '-end').val(),
                    breaks: []
                };

                $('.breaks tr').each(function (index, tr) {
                    var day = this.convertDayToValue($(tr).find('.break-day').text());
                    if (day == id) {
                        var start = $(tr).find('.break-start').text();
                        var end = $(tr).find('.break-end').text();

                        workingPlan[id].breaks.push({
                            start: start,
                            end: end
                        });
                    }

                    workingPlan[id].breaks.sort(function (break1, break2) {
                        // We can do a direct string comparison since we have time based on 24 hours clock.
                        return break1.start - break2.start;
                    });
                }.bind(this));
            } else {
                workingPlan[id] = null;
            }
        }.bind(this));

        $('.dayoff-date').each(function(){
            var date = $(this).text();
            workingPlan.daysoff.push(date);
        });
        return workingPlan;
    };

    /**
     * Enables or disables the timepicker functionality from the working plan input text fields.
     *
     * @param {Boolean} disabled (OPTIONAL = false) If true then the timepickers will be disabled.
     */
    WorkingPlan.prototype.timepickers = function (disabled) {
        disabled = disabled || false;

        $('.working-plan input:text').pickatime({
            min: [9,0],
            max: [18,0],
            format: 'HH:i',
            onSet: function(context) {
                // Start time must be earlier than end time.
                var start = Date.parse($(this).parent().parent().find('.work-start').val()),
                    end = Date.parse($(this).parent().parent().find('.work-end').val());

                if (start > end) {
                    $(this).parent().parent().find('.work-end').val(start.addHours(1).toString('h:mm tt'));
                }
            }
        });
    };

    /**
     * Reset the current plan back to the company's default working plan.
     */
    WorkingPlan.prototype.reset = function () {

    };

    /**
     * This is necessary for translated days.
     *
     * @param {String} value Day value could be like "monday", "tuesday" etc.
     */
    WorkingPlan.prototype.convertValueToDay = function (value) {
        switch (value) {
            case 'sunday':
                return 'Sunday';
            case 'monday':
                return 'Monday';
            case 'tuesday':
                return 'Tuesday';
            case 'wednesday':
                return 'Wednesday';
            case 'thursday':
                return 'Thursday';
            case 'friday':
                return 'Friday';
            case 'saturday':
                return 'Saturday';
        }
    };

    /**
     * This is necessary for translated days.
     *
     * @param {String} value Day value could be like "Monday", "Tuesday" etc.
     */
    WorkingPlan.prototype.convertDayToValue = function (day) {
        switch (day) {
            case 'Sunday':
                return 'sunday';
            case 'Monday':
                return 'monday';
            case 'Tuesday':
                return 'tuesday';
            case 'Wednesday':
                return 'wednesday';
            case 'Thursday':
                return 'thursday';
            case 'Friday':
                return 'friday';
            case 'Saturday':
                return 'saturday';
        }
    };

    window.WorkingPlan = WorkingPlan;

})();