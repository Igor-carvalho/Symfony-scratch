define("INotificationOptions", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
});
define("position/IPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
});
define("position/TopRightPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var TopRightPosition = /** @class */ (function () {
        function TopRightPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        TopRightPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopRightPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            this.notification.style['top'] = offset + 'px';
            this.notification.style['right'] = this.margin + 'px';
        };
        TopRightPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopRightPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style['top'] = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        TopRightPosition.position = 'top-right';
        return TopRightPosition;
    }());
    exports.TopRightPosition = TopRightPosition;
});
define("position/TopCenterPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var TopCenterPosition = /** @class */ (function () {
        function TopCenterPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        TopCenterPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopCenterPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            var width = parseInt(window.getComputedStyle(this.notification).width, 10);
            this.notification.style.top = offset + 'px';
            this.notification.style.left = 'calc(50% - ' + (Math.ceil(width / 2)) + 'px)';
        };
        TopCenterPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopCenterPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style.top = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        TopCenterPosition.position = 'top-center';
        return TopCenterPosition;
    }());
    exports.TopCenterPosition = TopCenterPosition;
});
define("position/BottomRightPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var BottomRightPosition = /** @class */ (function () {
        function BottomRightPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        BottomRightPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomRightPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            this.notification.style.bottom = offset + 'px';
            this.notification.style.right = this.margin + 'px';
        };
        BottomRightPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomRightPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style.bottom = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        BottomRightPosition.position = 'bottom-right';
        return BottomRightPosition;
    }());
    exports.BottomRightPosition = BottomRightPosition;
});
define("position/TopLeftPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var TopLeftPosition = /** @class */ (function () {
        function TopLeftPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        TopLeftPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopLeftPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            this.notification.style.top = offset + 'px';
            this.notification.style.left = this.margin + 'px';
        };
        TopLeftPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + TopLeftPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style.top = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        TopLeftPosition.position = 'top-left';
        return TopLeftPosition;
    }());
    exports.TopLeftPosition = TopLeftPosition;
});
define("position/BottomCenterPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var BottomCenterPosition = /** @class */ (function () {
        function BottomCenterPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        BottomCenterPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomCenterPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            var width = parseInt(window.getComputedStyle(this.notification).width, 10);
            this.notification.style.bottom = offset + 'px';
            this.notification.style.left = 'calc(50% - ' + (Math.ceil(width / 2)) + 'px)';
        };
        BottomCenterPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomCenterPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style.bottom = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        BottomCenterPosition.position = 'bottom-center';
        return BottomCenterPosition;
    }());
    exports.BottomCenterPosition = BottomCenterPosition;
});
define("position/BottomLeftPosition", ["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var BottomLeftPosition = /** @class */ (function () {
        function BottomLeftPosition(notification, margin) {
            this.notification = notification;
            this.margin = margin;
        }
        BottomLeftPosition.prototype.calculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomLeftPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
            this.notification.style.bottom = offset + 'px';
            this.notification.style.left = this.margin + 'px';
        };
        BottomLeftPosition.prototype.recalculate = function () {
            var _this = this;
            var offset = this.margin;
            var notifications = [].slice.call(document.querySelectorAll('.growl-notification.position-' + BottomLeftPosition.position));
            notifications.slice().forEach(function (el) {
                if (el !== _this.notification) {
                    el.style.bottom = offset + 'px';
                    offset += (Number(el.clientHeight)) + _this.margin;
                }
            });
        };
        BottomLeftPosition.position = 'bottom-left';
        return BottomLeftPosition;
    }());
    exports.BottomLeftPosition = BottomLeftPosition;
});
define("position/PositionFactory", ["require", "exports", "position/TopRightPosition", "position/TopCenterPosition", "position/BottomRightPosition", "position/TopLeftPosition", "position/BottomCenterPosition", "position/BottomLeftPosition"], function (require, exports, TopRightPosition_1, TopCenterPosition_1, BottomRightPosition_1, TopLeftPosition_1, BottomCenterPosition_1, BottomLeftPosition_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var PositionFactory = /** @class */ (function () {
        function PositionFactory() {
        }
        PositionFactory.newInstance = function (position, notification, margin) {
            var positionClass = null;
            if (position === TopRightPosition_1.TopRightPosition.position) {
                positionClass = TopRightPosition_1.TopRightPosition;
            }
            else if (position === TopCenterPosition_1.TopCenterPosition.position) {
                positionClass = TopCenterPosition_1.TopCenterPosition;
            }
            else if (position === BottomRightPosition_1.BottomRightPosition.position) {
                positionClass = BottomRightPosition_1.BottomRightPosition;
            }
            else if (position === TopLeftPosition_1.TopLeftPosition.position) {
                positionClass = TopLeftPosition_1.TopLeftPosition;
            }
            else if (position === BottomCenterPosition_1.BottomCenterPosition.position) {
                positionClass = BottomCenterPosition_1.BottomCenterPosition;
            }
            else if (position === BottomLeftPosition_1.BottomLeftPosition.position) {
                positionClass = BottomLeftPosition_1.BottomLeftPosition;
            }
            return new positionClass(notification, margin);
        };
        return PositionFactory;
    }());
    exports.PositionFactory = PositionFactory;
});
define("GrowlNotification", ["require", "exports", "position/PositionFactory"], function (require, exports, PositionFactory_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var GrowlNotification = /** @class */ (function () {
        function GrowlNotification(options) {
            if (options === void 0) { options = {}; }
            var d = document;
            this.options = GrowlNotification.assignOptions({}, GrowlNotification.defaultOptions, options);
            // Disable animation duration if animation close set to 'none'
            if (!this.options.animation.close || this.options.animation.close == 'none') {
                this.options.animationDuration = 0;
            }
            this.notification = d.createElement('div');
            this.body = d.querySelector('body');
            this.template = GrowlNotification.template;
            this.position = PositionFactory_1.PositionFactory.newInstance(this.options.position, this.notification, this.options.margin);
        }
        Object.defineProperty(GrowlNotification, "defaultOptions", {
            get: function () {
                return {
                    margin: 20,
                    type: 'alert',
                    title: '',
                    description: '',
                    image: '',
                    closeTimeout: false,
                    closeWith: ['click', 'button'],
                    animation: {
                        open: 'slide-in',
                        close: 'slide-out'
                    },
                    animationDuration: .3,
                    position: 'top-right'
                };
            },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(GrowlNotification, "template", {
            get: function () {
                return "<span class=\"growl-notification__close\">\n             <span class=\"ua-icon-alert-close\"></span>\n           </span>\n           {{ image }}\n           <div class=\"growl-notification__content\">\n             <div class=\"growl-notification__title\">{{ title }}</div>\n             <div class=\"growl-notification__desc\">{{ description }}</div>\n           </div>";
            },
            enumerable: true,
            configurable: true
        });
        GrowlNotification.notify = function (options) {
            if (options === void 0) { options = {}; }
            return (new GrowlNotification(options)).show();
        };
        GrowlNotification.prototype.show = function () {
            this.addNotification();
            this.initPosition();
            this.initCloseEvents();
            return this;
        };
        GrowlNotification.prototype.close = function () {
            var self = this;
            var classList = this.notification.classList;
            classList.remove('animation-' + this.options.animation.open);
            classList.add('animation-' + this.options.animation.close);
            classList.add('growl-notification--closed');
            console.log(this.options.animationDuration);
            setTimeout(function () {
                self.remove();
                self.position.recalculate();
            }, this.options.animationDuration * 1000);
        };
        GrowlNotification.prototype.remove = function () {
            this.notification.remove();
            return this;
        };
        /**
         * Add notification to document
         */
        GrowlNotification.prototype.addNotification = function () {
            var options = this.options;
            var template = this.template.replace('{{ title }}', options.title);
            template = template.replace('{{ image }}', options.image ? '<img src="' + options.image + '" alt="" class="growl-notification__image">' : '');
            template = template.replace('{{ description }}', options.description);
            var classList = this.notification.classList;
            classList.add('growl-notification');
            classList.add('growl-notification--' + options.type);
            classList.add('animation-' + options.animation.open);
            classList.add('position-' + options.position);
            if (options.image) {
                classList.add('growl-notification--image');
            }
            this.notification.innerHTML = template;
        };
        /**
         * Calculate and set notification positions
         */
        GrowlNotification.prototype.initPosition = function () {
            this.body.appendChild(this.notification);
            this.position.calculate();
        };
        GrowlNotification.prototype.initCloseEvents = function () {
            var self = this;
            if (this.options.closeWith.indexOf('click') > -1) {
                this.notification.classList.add('growl-notification--close-on-click');
                this.notification.addEventListener('click', function () { return self.close(); });
            }
            else if (this.options.closeWith.indexOf('button') > -1) {
                var closeBtn = this.notification.querySelector('.growl-notification__close');
                closeBtn.addEventListener('click', function () { return self.close(); });
            }
            if (this.options.closeTimeout && (this.options.closeTimeout > 0)) {
                setTimeout(function () { return self.close(); }, this.options.closeTimeout);
            }
        };
        GrowlNotification.assignOptions = function (target) {
            var sources = [];
            for (var _i = 1; _i < arguments.length; _i++) {
                sources[_i - 1] = arguments[_i];
            }
            if (target === null) {
                throw new TypeError('Cannot convert undefined or null to object');
            }
            var to = Object(target);
            for (var index = 1; index < arguments.length; index++) {
                var nextSource = arguments[index];
                if (nextSource !== null) {
                    for (var nextKey in nextSource) {
                        if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
                            to[nextKey] = nextSource[nextKey];
                        }
                    }
                }
            }
            return to;
        };
        return GrowlNotification;
    }());
    exports.GrowlNotification = GrowlNotification;
});
