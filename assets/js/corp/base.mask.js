/*
* Máscaras para campos de formulário utilizando a biblioteca cleave.js
*
* @see https://github.com/nosir/cleave.js
* Opções de uso:
* @see https://github.com/nosir/cleave.js/blob/master/doc/options.md
*
* */
document.addEventListener("DOMContentLoaded", function (e) {

    /*  Máscara de CPF para o campo input.mask-cpf */
    if (document.querySelectorAll('.mask-cpf').length > 0) {
        new Cleave('.mask-cpf', {
            blocks: [3, 3, 3, 2],
            delimiters: ['.', '.', '-'],
            numericOnly: true
        });
    }

    /*  Máscara de valor */
    if (document.querySelectorAll('.mask-valor').length > 0) {
        new Cleave('.mask-valor', {
            numeral: true,
            numeralDecimalMark: '.'
        });
    }

    /*  Máscara de PIS para o campo input.mask-pis */
    if (document.querySelectorAll('.mask-pis').length > 0) {
        new Cleave('.mask-pis', {
            blocks: [3, 5, 2, 1],
            delimiters: ['.', '.', '-'],
            numericOnly: true
        });
    }

    /*  Máscara de CEP para o campo input.mask-cep */
    if (document.querySelectorAll('.mask-cep').length > 0) {
        new Cleave('.mask-cep', {
            blocks: [2, 3, 3],
            delimiters: ['.', '-'],
            numericOnly: true
        });
    }

    /*  Máscara de Data para o campo input.mask-dataNasc */
    if (document.querySelectorAll('.mask-data').length > 0) {
        new Cleave('.mask-data', {
            date: true,
            dateMax: dataAtual('yyyy-mm-dd'),
            pattern: ['d','m','Y']
        });
    }

    /*  Máscara de cpf somente números para o campo input.mask-login */
    if (document.querySelectorAll('.mask-login').length > 0) {
        new Cleave('.mask-login', {
            blocks: [11],
            numericOnly: true
        });
    }

    /*  Máscara de número para o campo numero da rubrica */
    if (document.querySelectorAll('.mask-numero-rubrica').length > 0) {
        new Cleave('.mask-numero-rubrica', {
            blocks: [4],
            numericOnly: true,
            stripLeadingZeroes: false,
        });
    }

});
