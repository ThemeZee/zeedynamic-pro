/**
 * Custom Font Control JS
 *
 * Adds Javascript for the Custom Font Control in the Customizer. Ensures that Prev/Next/Default Font buttons work.
 *
 * @package zeeDynamic Pro
 */
 
( function( wp, $ ) {
	/**
	 * The Customizer looks for wp.customizer.controlConstructor[type] functions
	 * where type == the type member of a WP_Customize_Control
	 */
	wp.customize.controlConstructor.zeedynamic_pro_custom_font = wp.customize.Control.extend({
		/**
		 * This method is called when the control is ready to run.
		 * Do all of your setup and event binding here.
		 */
		ready: function() {
			// this.container is a jQuery object of your container

			// grab the bits of data from the title for specifying this control
			var data = this.container.find( '.customize-control-title' ).data();

			// Use specific l10n data for this control where available
			this.l10n = data.l10n;
			
			// Set default font
			this.font = data.font;

			// Set up button elements. Cache for re-use.
			this.$btnContainer = this.container.find( '.actions' );
			this.$btnStandard = $( '<button type="button" class="button standard">' + this.l10n.standard + '</button>' ).prependTo( this.$btnContainer );
			this.$btnNext = $( '<button type="button" class="button next" title="' + this.l10n.next + '">&raquo;</button>' ).prependTo( this.$btnContainer );
			this.$btnPrevious = $( '<button type="button" class="button previous" title="' + this.l10n.previous + '">&laquo;</button>' ).prependTo( this.$btnContainer );

			// handy shortcut so we don't have to us _.bind every time we add a callback
			_.bindAll( this, 'standard', 'next', 'previous' );

			this.$btnStandard.on( 'click', this.standard );
			this.$btnNext.on( 'click', this.next );
			this.$btnPrevious.on( 'click', this.previous );

		},
		/**
		 * Called when the "Default" link is clicked. Sets the font to the default theme font
		 * @param  {object} event jQuery Event object from click event
		 */
		standard: function( event ) {
			event.preventDefault();
			var select = this.container.find('select');
			
			select.find('option[selected]').removeAttr('selected');
			select.find('option[value="' + this.font + '"]').attr('selected', 'selected');
			select.trigger('change');
		},
		/**
		 * Called when the "Next" link is clicked. Iterates to the next value in the select field.
		 * @param  {object} event jQuery Event object from click event
		 */
		next: function( event ) {
			event.preventDefault();
			var select = this.container.find('select');
			var current = select.find('option').filter(':selected');
			var next = this.nextOrFirst(current);
			
			current.removeAttr('selected');
			next.attr('selected', 'selected');
			select.trigger('change');
		},
		/**
		 * Called when the "Previous" link is clicked. Iterates to the previous value in the select field.
		 * @param  {object} event jQuery Event object from click event
		 */
		previous: function( event ) {
			event.preventDefault();
			var select = this.container.find('select');
			var current = select.find('option').filter(':selected');
			var previous = this.prevOrLast(current);
			
			current.removeAttr('selected');
			previous.attr('selected', 'selected');
			select.trigger('change');
		},
		/**
		* nextOrFirst()
		* Works like next(), except gets the first item from siblings if there is no "next" sibling to get.
		*/
		nextOrFirst: function(selector) {
			var next = selector.next();
			return (next.length) ? next : selector.prevAll().last();
		},
		/**
		* prevOrLast()
		* Works like prev(), except gets the last item from siblings if there is no "prev" sibling to get.
		*/
		prevOrLast: function(selector) {
			var prev = selector.prev();
			return (prev.length) ? prev : selector.nextAll().last();
		}

	});
	
	/**
	 * Custom Control JS for Available Fonts Setting
	 */
	wp.customize.controlConstructor.zeedynamic_pro_custom_font_list = wp.customize.Control.extend({
		/**
		 * This method is called when the control is ready to run.
		 * Do all of your setup and event binding here.
		 */
		ready: function() {
			// this.container is a jQuery object of your container

			// grab the bits of data from the title for specifying this control
			var data = this.container.find( '.custom-font-lists' ).data();

			// Use specific l10n data for this control where available
			this.l10n = data.l10n;
			
			// Set font lists
			this.browser_fonts = data.standard;
			this.favorite_fonts = data.favorite;
			this.popular_fonts = data.popular;
			this.all_fonts = data.all;

			// Set up button elements. Cache for re-use.
			this.$btnContainer = this.container.find( '.actions' );
			this.$btnUpdate = $( '<button type="button" class="button update">' + this.l10n.update + '</button>' ).prependTo( this.$btnContainer );
			
			// handy shortcut so we don't have to us _.bind every time we add a callback
			_.bindAll( this, 'update' );

			this.$btnUpdate.on( 'click', this.update );

		},
		/**
		 * Called when the "Update Fonts" link is clicked. Adds the new font set to the font select fields
		 * @param  {object} event jQuery Event object from click event
		 */
		update: function( event ) {
			event.preventDefault();
			
			// Set Font List HTML Output
			var font_output = '';
			
			// Create Font Array
			var font_array = [];
			
			// Get Selected Font Set
			var selected = this.container.find('select option').filter(':selected');
			
			// Get Font Settings Controls
			var text_font = $('#customize-control-text_font').find('select');
			var title_font = $('#customize-control-title_font').find('select');
			var navi_font = $('#customize-control-navi_font').find('select');
			var widget_title_font = $('#customize-control-widget_title_font').find('select');
			
			// Get current selected values
			var text_font_current = text_font.find('option').filter(':selected').val();
			var title_font_current = title_font.find('option').filter(':selected').val();
			var navi_font_current = navi_font.find('option').filter(':selected').val();
			var widget_title_font_current = widget_title_font.find('option').filter(':selected').val();
			
			// Retrieve all Fonts from this Set
			if( selected.val() == 'all' ) {
				var fonts = this.all_fonts;
			} else if( selected.val() == 'popular' ) {
				var fonts = this.popular_fonts;
			} else if( selected.val() == 'default' ) {
				var fonts = this.browser_fonts;
			} else {
				var fonts = this.favorite_fonts;
			}
			
			// Create Font Array
			for (var key in fonts) {
				if (fonts.hasOwnProperty(key)) {
					font_array.push(fonts[key]);
				}
			}
			
			// Add currently selected fonts
			if( $.inArray( text_font_current, font_array ) < 0 ) {
				font_array.push(text_font_current);
			}
			if( $.inArray( title_font_current, font_array ) < 0 ) {
				font_array.push(title_font_current);
			}
			if( $.inArray( navi_font_current, font_array ) < 0 ) {
				font_array.push(navi_font_current);
			}
			if( $.inArray( widget_title_font_current, font_array ) < 0 ) {
				font_array.push(widget_title_font_current);
			}
			
			// Sort Array
			font_array.sort();
						
			// Loop through fonts
			$.each(font_array, function(key,value) {
				
				// Create HTML options
				font_output += '<option value="'+value+'">'+value+'</option>';

			});
			
			// Add HTML Output to Font Controls
			text_font.html(font_output);
			title_font.html(font_output);
			navi_font.html(font_output);
			widget_title_font.html(font_output);

			// Re-select active value
			text_font.find('option[value="' + text_font_current + '"]').attr('selected', 'selected');
			title_font.find('option[value="' + title_font_current + '"]').attr('selected', 'selected');
			navi_font.find('option[value="' + navi_font_current + '"]').attr('selected', 'selected');
			widget_title_font.find('option[value="' + widget_title_font_current + '"]').attr('selected', 'selected');


		}
	});

})( this.wp, jQuery );