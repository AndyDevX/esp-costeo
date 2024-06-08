document.addEventListener('DOMContentLoaded', function() {
    const textInput = document.getElementById('textInput');
    const binaryInput = document.getElementById('binaryInput');
    const binaryOutput = document.getElementById('binaryOutput');
    const textOutput = document.getElementById('textOutput');

    textInput.addEventListener('input', function() {
        const text = textInput.value;
        binaryOutput.textContent = textToBinary(text);
    });

    binaryInput.addEventListener('input', function() {
        const binary = binaryInput.value;
        textOutput.textContent = binaryToText(binary);
    });

    function textToBinary(text) {
        return text.split(/(\d+)/).filter(Boolean).map(part => {
            if (!isNaN(part)) {
                return parseInt(part, 10).toString(2).padStart(8, '0');
            } else {
                return part.split('').map(char => {
                    return char.charCodeAt(0).toString(2).padStart(8, '0');
                }).join(' ');
            }
        }).join(' ');
    }

    function binaryToText(binary) {
        return binary.split(' ').map(bin => {
            const decimalValue = parseInt(bin, 2);
            
            if (decimalValue >= 48 && decimalValue <= 57) {
                return String.fromCharCode(decimalValue);
            } else {
                return String.fromCharCode(decimalValue);
            }
        }).join('');
    }
});
