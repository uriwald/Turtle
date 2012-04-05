//
// Turtle Graphics in Javascript
//

// Copyright 2009 Joshua Bell
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
// http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

/*global CanvasTextFunctions */

//----------------------------------------------------------------------
function CanvasTurtle(canvas_ctx, turtle_ctx, width, height)
//----------------------------------------------------------------------
{
    function deg2rad(d) {
        return d / 180 * Math.PI;
    }
    function rad2deg(r) {
        return r * 180 / Math.PI;
    }

    var self = this;
    
    canvas_ctx.lineCap = 'round';

    turtle_ctx.lineCap = 'round';
    turtle_ctx.strokeStyle = 'green';
    turtle_ctx.lineWidth = 2;

    self.x = width / 2;
    self.y = height / 2;
    self.r = Math.PI / 2;
    self.down = true;
    self.color = '#000000';
    self.fontsize = 14;
    self.width = 1;
    self.turtlemode = 'wrap';
    self.penmode = 'paint';
    self.visible = true;

    /*private*/function moveto(x, y) {

        function _go(x1, y1, x2, y2) {
            if (self.down) {
                canvas_ctx.strokeStyle = self.color;
                canvas_ctx.lineWidth = self.width;
                canvas_ctx.globalCompositeOperation =
                (self.penmode === 'erase') ? 'destination-out' :
                (self.penmode === 'reverse') ? 'xor' : 'source-over';
                canvas_ctx.beginPath();
                canvas_ctx.moveTo(x1, y1);
                canvas_ctx.lineTo(x2, y2);
                canvas_ctx.stroke();
            }
        }

        var ix, iy, wx, wy, fx, fy, less;
        
        while (true) {
            // *TODO: What happens if we switch modes and turtle is outside bounds?
            
            switch (self.turtlemode) {
                case 'window':
                    _go(self.x, self.y, x, y);
                    self.x = x;
                    self.y = y;
                    return;

                default:
                case 'wrap':
                case 'fence':

                    // fraction before intersecting
                    fx = 1;
                    fy = 1;

                    if (x < 0) {
                        fx = (self.x - 0) / (self.x - x);
                    }
                    else if (x >= width) {
                        fx = (self.x - width) / (self.x - x);
                    }

                    if (y < 0) {
                        fy = (self.y - 0) / (self.y - y);
                    }
                    else if (y >= height) {
                        fy = (self.y - height) / (self.y - y);
                    }

                    // intersection point (draw current to here)
                    ix = x;
                    iy = y;

                    // endpoint after wrapping (next "here")
                    wx = x;
                    wy = y;

                    if (fx < 1 && fx <= fy) {
                        less = (x < 0);
                        ix = less ? 0 : width;
                        iy = self.y - fx * (self.y - y);
                        x += less ? width : -width;
                        wx = less ? width : 0;
                        wy = iy;
                    }
                    else if (fy < 1 && fy <= fx) {
                        less = (y < 0);
                        ix = self.x - fy * (self.x - x);
                        iy = less ? 0 : height;
                        y += less ? height : -height;
                        wx = ix;
                        wy = less ? height : 0;
                    }

                    _go(self.x, self.y, ix, iy);

                    if (self.turtlemode === 'fence') {
                        // FENCE - stop on collision
                        self.x = ix;
                        self.y = iy;
                        return;
                    }
                    else {
                        // WRAP - keep going
                        self.x = wx;
                        self.y = wy;
                        if (fx === 1 && fy === 1) {
                            return;
                        }
                    }

                    break;                
            }
        }
    }

    this.move = function(distance) {
        var x = self.x + distance * Math.cos(self.r);
        var y = self.y - distance * Math.sin(self.r);
        moveto(x, y);
    };

    this.turn = function(angle) {
        self.r -= deg2rad(angle);
    };

    this.penup = function() {
        self.down = false;
    };
    this.pendown = function() {
        self.down = true;
    };

    this.setpenmode = function(penmode) {
        this.penmode = penmode;
    };
    this.getpenmode = function() {
        return this.penmode;
    };

    this.setturtlemode = function(turtlemode) {
        this.turtlemode = turtlemode;
    };
    this.getturtlemode = function() {
        return this.turtlemode;
    };

    this.ispendown = function() {
        return self.down;
    };

    var STANDARD_COLORS = {
        0: "black",     
        1: "blue",      
        2: "lime",     
        3: "cyan",
        4: "red",       
        5: "magenta",   
        6: "yellow",   
        7: "white",
        8: "brown",     
        9: "tan",      
        10: "green",   
        11: "aquamarine",
        12: "salmon",  
        13: "purple",   
        14: "orange",  
        15: "gray"
    };

    this.setcolor = function(color) {
        if (STANDARD_COLORS[color] !== undefined) {
            self.color = STANDARD_COLORS[color];
        }
        else {
            self.color = color;
        }
    };
    this.getcolor = function() {
        return self.color;
    };

    this.setwidth = function(width) {
        self.width = width;
    };
    this.getwidth = function() {
        return self.width;
    };
    
    this.setfontsize = function(size) {
        self.fontsize = size;
    };
    this.getfontsize = function() {
        return self.fontsize;
    };

    this.setposition = function(x, y) {
        x = (x === undefined) ? self.x : x + (width / 2);
        y = (y === undefined) ? self.y : -y + (height / 2);

        moveto(x, y);
    };

    this.towards = function(x, y) {
        x = x + (width / 2);
        y = -y + (height / 2);

        return 90 - rad2deg(Math.atan2(self.y - y, x - self.x));
    };

    this.setheading = function(angle) {
        self.r = deg2rad(90 - angle);
    };

    this.clearscreen = function() {
        self.home();
        self.clear();
    };

    this.clear = function() {
        canvas_ctx.clearRect(0, 0, width, height);
    };

    this.home = function() {
        moveto(width / 2, height / 2);
        self.r = deg2rad(90);
    };

    this.showturtle = function() {
        self.visible = true;
    };

    this.hideturtle = function() {
        self.visible = false;
    };

    this.isturtlevisible = function() {
        return self.visible;
    };

    this.getheading = function() {
        return 90 - rad2deg(self.r);
    };

    this.getxy = function() {
        return [self.x - (width / 2), -self.y + (height / 2)];
    };

    this.drawtext = function(text) {
        canvas_ctx.save();
        canvas_ctx.translate(self.x, self.y);
        canvas_ctx.rotate(-self.r);
        canvas_ctx.font = self.fontsize + 'px sans-serif';
        canvas_ctx.fillStyle = self.color;
        canvas_ctx.strokeStyle = self.color;
        canvas_ctx.fillText(text, 0, 0);
        canvas_ctx.restore();
    };


    this.begin = function() {
        // Erase turtle
        turtle_ctx.clearRect(0, 0, width, height);

        // Stub for old browsers w/ canvas but no text functions
        if (!canvas_ctx.fillText) {
            canvas_ctx.fillText = function(string, x, y) { };        
    }
};

this.end = function() {

        
    if (self.visible) {
        var ctx = turtle_ctx;
        ctx.beginPath();
        ctx.moveTo(self.x + Math.cos(self.r) * 20, self.y - Math.sin(self.r) * 20);
        ctx.lineTo(self.x + Math.cos(self.r - Math.PI * 2 / 3) * 10, self.y - Math.sin(self.r - Math.PI * 2 / 3) * 10);
        ctx.lineTo(self.x + Math.cos(self.r + Math.PI * 2 / 3) * 10, self.y - Math.sin(self.r + Math.PI * 2 / 3) * 10);
        ctx.lineTo(self.x + Math.cos(self.r) * 20, self.y - Math.sin(self.r) * 20);
        ctx.stroke();
    }
};

self.begin();
self.end();

} // CanvasTurtle

