function enforcePhoneNumberFormat(input) {
    const phoneNumber = input.value;
    
    if (phoneNumber.slice(0, 2) !== "07") {
        input.value = "07";
    } else if (phoneNumber.length < 2) {
        input.value = "07";
    }
}

function addHyphen (element) {
    let ele = document.getElementById(element.id);
    ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.

    let finalVal = ele.match(/.{1,3}/g).join('-');
    document.getElementById(element.id).value = finalVal;
}