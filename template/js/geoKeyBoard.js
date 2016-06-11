(function() {
    
    String.prototype.pasteTo = function(field) {
        field.focus();
        if (document.selection) {
            var range = document.selection.createRange();
            if (range) {                
                range.text = this;
            }
        } else if (field.selectionStart != undefined) {
            var scrollTop = field.scrollTop, start = field.selectionStart, end = field.selectionEnd;
            var value = field.value.substring(0, start) + this + field.value.substring(end, field.value.length);
            field.value = value;
            field.scrollTop = scrollTop;
            field.setSelectionRange(start + this.length, start + this.length); 
        } else {
            field.value += this;
            field.setSelectionRange(field.value.length, field.value.length);        
        }
    };
    
    String.prototype.translateToKA = function() {
        
        var index, chr, text = [], symbols = "abgdevzTiklmnopJrstufqRySCcZwWxjh";
        
        for (var i = 0; i < this.length; i++) {
            chr = this.substr(i, 1);
            if ((index = symbols.indexOf(chr)) >= 0) {
                text.push(String.fromCharCode(index + 4304));
            } else {
                text.push(chr);
            }
        }
        
        return text.join('');
        
    };
        
    GeoKBD = {
        
        browser: {
            isOpera: navigator.userAgent.toLowerCase().indexOf('opera') > -1,
            isIe: navigator.userAgent.toLowerCase().indexOf('msie') > -1,
            isIe6: navigator.userAgent.toLowerCase().indexOf('msie 6') > -1,
            isIe7: navigator.userAgent.toLowerCase().indexOf('msie 7') > -1
        },
        
        event: {
            
            get: function(e) {
                return e || window.event;
            },
            
            getKeyCode: function(e) {
                e = this.get(e);
                return e.keyCode || e.which;
            },
            
            targetIs: function(e, tagName) {
                e = this.get(e);
                var t = e.target || e.srcElement;
                return t.tagName.toLowerCase() == tagName ? t : null;
            },
            
            attach: function(obj, eventName, fnc, capture) {
                if (obj.addEventListener) {
                    obj.addEventListener(eventName, fnc, capture);
                } else if (obj.attachEvent) {
                    return obj.attachEvent('on' + eventName, fnc);
                } else {
                    obj['on' + eventName] = fnc;
                }   
            },
            
            detach: function(obj, eventName, fnc, capture) {
                if (obj.removeEventListener) {
                    obj.removeEventListener(eventName, fnc, capture);
                } else if (obj.detachEvent) {
                    obj.detachEvent('on' + eventName, fnc);
                } else {
                    obj['on' + eventName] = null;
                }
            },
            
            cancel: function(e) {
                e = this.get(e);
                if (e.stopPropagation) {
                    e.stopPropagation();
                    e.preventDefault();
                } else {
                    e.cancelBubble = true;
                    e.returnValue = false;
                }
            }
            
        },
        
        keyHandlers: {},
        
        addKeyHandler: function(key, callback) {
            if (typeof key == 'string') {
                key = key.charCodeAt(0);
            }
            if (!this.keyHandlers[key]) {
                this.keyHandlers[key] = [];
            }
            this.keyHandlers[key].push(callback);
        },
        
        handleKey: function(key) {
            if (GeoKBD.keyHandlers[key]) {
                var handler = null;
                for (var i = 0; i < GeoKBD.keyHandlers[key].length; i++) {
                    handler = GeoKBD.keyHandlers[key][i];
                    if (handler.constructor && handler.constructor == Array) {
                        handler[0][handler[1]].call(handler[0], key);
                    } else {
                        handler(key);
                    }
                }
            }
        },
        
        map: function(form, fieldName, switcher) {
            
            var self = this, names = [], forms = [];
            
            if (form) {
                if (form.constructor) {
                    if (form.constructor == String) {
                        names.push(form);
                    } else if (form.constructor == Array) {
                        names = form;
                    }
                    if (names.length) {
                        for (var idx in names) {
                            if (document.forms[names[idx]]) {
                                forms.push(document.forms[names[idx]]);
                            }
                        }
                    }
                } else {
                    forms.push(form);
                }
            } else {
                forms = document.forms;
            }
                        
            for (var idx = 0; idx < forms.length; idx++) {
                
                form = forms[idx];
                        
                if (!form.fields || form.fields == undefined) form.fields = {};
                if (form.ka == undefined) form.ka = form[switcher] ? form[switcher].checked : true;
                
                if (fieldName) {
                    if (typeof fieldName == 'string') fieldName = [fieldName];
                    for (var i = 0; i < fieldName.length; i++) {
                        if (form[fieldName[i]] && !form.fields[fieldName[i]]) form.fields[fieldName[i]] = fieldName[i];
                    }
                } else {
                    var name, type;
                    for (var i = 0; i < form.elements.length; i++) {
                        if (form.elements[i].type) {
                            name = form.elements[i].name || form.elements[i].id; 
                            type = form.elements[i].type.toLowerCase();
                            if (name && (type == 'text' || type == 'textarea')) {
                                form.fields[name] = name;
                            }
                        }
                    }
                }
                
                switcher = switcher || 'geo';
                form.switcher = switcher;
                                            
                form.onkeypress = function(e) {
                    
                    e = self.event.get(e);
                    if (e.altKey || e.ctrlKey) return;
                    
                    if (!self.browser.isIe && !self.browser.isOpera && !e.charCode) {
                        return;
                    }
                    
                    var target, _switcher = switcher, keyCode = self.event.getKeyCode(e);
                    
                    if (keyCode == 96) {
                        if (this[_switcher]) {
                            this.ka = this[_switcher].checked = !this[_switcher].checked;
                        } else {
                            this.ka = !this.ka;
                        }
                        return false;
                    } else if (this[_switcher]) {
                        this.ka = this[_switcher].checked;
                    }
                    
                    if (!this.ka) return;
                    
                    if ((target = (self.event.targetIs(e, 'textarea') || self.event.targetIs(e, 'input')))) {
                        if (!this.fields[target.name || target.id]) return;
                        text = String.fromCharCode(keyCode);
                        kaText = text.translateToKA();
                        if (kaText != text) {
                            if (GeoKBD.browser.isIe) {
                                e.keyCode = kaText.charCodeAt(0);
                            } else {
                                kaText.pasteTo(target);
                                return false;
                            }
                        }
                    }
                }
            
            }
            
            form = forms = names = null;
            
        },
        
        mapIFrame: function(iframe) {
            
            var __keypress = function(e) {
                
                if (e.altKey || e.ctrlKey) return;
                var doc = (e.target || e.srcElement).ownerDocument;
                if (doc.ka == undefined) doc.ka = true;
                var keyCode = GeoKBD.event.getKeyCode(e);
                var text = String.fromCharCode(keyCode);
                var form, switcher;
                if (parent.document.forms[doc.parentForm]) {
                    form = parent.document.forms[doc.parentForm];
                    if (form.switcher && form[form.switcher]) {
                        switcher = form[form.switcher];
                    }
                }
                
                if (keyCode == 96) {
                    doc.ka = !doc.ka;                   
                    if (switcher) switcher.checked = doc.ka;
                    GeoKBD.event.cancel(e);
                } else if (switcher) {
                    doc.ka = switcher.checked;
                }
                
                form = switcher = null;
                
                if (doc.ka) {               
                    var kaText = text.translateToKA();
                    if (kaText != text) {
                        if (!GeoKBD.browser.isIe) {
                            doc.execCommand('InsertHTML', false, kaText);
                        } else {
                            var range = doc.selection.createRange();
                            range.pasteHTML(kaText);
                        }
                        GeoKBD.event.cancel(e);
                    }
                }
                
            }
            
            var __focus = function(e) {         
                if (!GeoKBD.browser.isIe) {
                    GeoKBD.event.attach(this.document, 'keypress', __keypress, true);
                    GeoKBD.event.detach(this, 'focus', __focus, true);
                } else {
                    GeoKBD.event.attach(this.contentWindow.document, 'keypress', __keypress, true);
                    this.onfocus = null;
                }
            };
            
            var interval = window.setInterval(function() {
                var el = typeof iframe=='string' ? document.getElementById(iframe) : iframe();
                if (el) {
                    for (var p = el.parentNode; p && p != document.body; p = p.parentNode) {
                        if (/form/i.test(p.tagName)) {
                            if (el.contentWindow.document) {
                                el.contentWindow.document.parentForm = p.name || p.id;
                            } else {
                                el.document.parentForm = p.name || p.id;
                            }
                            break;
                        }
                    }
                    if (!GeoKBD.browser.isIe) {     
                        GeoKBD.event.attach(el.contentWindow, 'focus', __focus, true);
                    } else {
                        el.onfocus = __focus;
                    }
                    el = null;
                    window.clearInterval(interval);
                }
            }, 100);
            
        }
        
    };
    
    window.GeoKBD = GeoKBD;

})();