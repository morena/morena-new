"use strict";

(function ($) {
  var zoomConnection = {
    init: function init() {
      this.formWrapper = $('#vczapi_zoom_connection');
      this.connectZoomInput = $('.vczapi-zoom-connect');
      this.enableZoomCheckbox = $('#_vczapi_enable_zoom_link');
      this.meetingData = '';
      this.initSelect2();
      this.enableZoomCheckbox.on('change', this.toggleZoomConnection.bind(this));
      this.connectZoomInput.on('change', this.updateMeetingInfo.bind(this));
    },
    initSelect2: function initSelect2() {
      /*
      @todo weird things are happening with WooCommerce select2 - need to check that out we dont want a dependency problem here.
       */
      this.connectZoomInput.select2({
        minimumInputLength: 3,
        ajax: {
          url: ajaxurl + '?action=vczapi_zoom_woocommerce_link&security=' + vczapiWC.nonce,
          dataType: 'json',
          data: function data(params) {
            return {
              search: params.term,
              product_id: zoomConnection.formWrapper.find('#vczapi-product-id').val()
            };
          },
          processResults: function processResults(response) {
            zoomConnection.meetingData = response.data.meetingData; // Transforms the top-level key of the response object from 'items' to 'results'

            return {
              results: response.data.items
            };
          }
        }
      });
    },
    toggleZoomConnection: function toggleZoomConnection(e) {
      var $el = $(e.currentTarget);

      if ($el.is(':checked')) {
        $('.zoom-connection-enabled').show();
      } else {
        $('.zoom-connection-enabled').hide();
      }
    },
    updateMeetingInfo: function updateMeetingInfo(e) {
      var $el = $(e.currentTarget);
      var selectedMeeting = $el.val(); //console.log(selectedMeeting);

      var meetingHTML = this.meetingData[selectedMeeting];

      if (meetingHTML !== '') {
        $('.vczapi-woocommerce--meeting-details').find('.info').html(meetingHTML);
      }
    }
  };
  var zoomRegistrantsTable = {
    init: function init() {
      this.registrantTable = $('#vczapi-wc-meeting-registrants-dtable');

      if (this.registrantTable !== undefined && this.registrantTable.length > 0) {
        this.registrantTable.dataTable({
          "pageLength": 10
        });
      }
    }
  }; //document ready

  $(function () {
    zoomConnection.init();
    zoomRegistrantsTable.init();
  });
})(jQuery);