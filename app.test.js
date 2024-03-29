const fs = require('fs');
const path = require('path');
const { JSDOM } = require('jsdom');

describe('mouseMoveHandler', () => {
    let dom, window, document, svg, selectedRect, mouseDownPos, rectPos, lines, e;

    beforeEach(() => {
        // Load the HTML file
        const html = fs.readFileSync(path.resolve(__dirname, './013-vẽ-lại-với-id-done.html'), 'utf8');

        // Create a new JSDOM instance
        dom = new JSDOM(html);
        window = dom.window;
        document = window.document;

        svg = document.querySelector('svg');
        selectedRect = document.querySelector('rect');
        mouseDownPos = { x: 70, y: 70 };
        rectPos = { x: 60, y: 60 };
        lines = [];
        e = { clientX: 100, clientY: 100 };

        // Define the function in the global scope of the JSDOM window
        window.mouseMoveHandler = function(e) {
            // function body ??
        };
    });

    


    /**
     * 
     */
    test('should move the rectangle when isMouseDown is true', () => {
        const isMouseDown = true;
        window.mouseMoveHandler(e, isMouseDown, svg, selectedRect, mouseDownPos, rectPos, lines);
        expect(selectedRect.getAttribute('x')).toBe('60');
        expect(selectedRect.getAttribute('y')).toBe('60');
    });

    test('should not move the rectangle when isMouseDown is false', () => {
        const isMouseDown = false;
        window.mouseMoveHandler(e, isMouseDown, svg, selectedRect, mouseDownPos, rectPos, lines);
        expect(selectedRect.getAttribute('x')).toBe('50');
        expect(selectedRect.getAttribute('y')).toBe('50');
    });
});