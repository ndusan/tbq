var App = App || {};
(function($){
    App.Core = {
    	exec: function( controller, method ) {
    		var ns = App,
                method = ( method === undefined ) ? "init" : method;
                controller = controller.charAt(0).toUpperCase() + controller.slice(1);
                if (controller !== "" && ns[controller] && typeof ns[controller][action] == "function") {
                        ns[controller][method]();
                }
    	},
    	init: function() {
    		var body = document.body,
                    controller = body.getAttribute( "data-controller" ),
                    method = body.getAttribute( "data-method" );
    			                
    		App.Core.exec(controller); //To run init
    		App.Core.exec(controller, method);
                
    	}
    };
    $(document).ready(App.Core.init);

})(this.jQuery);
