const openDialog = () => {
    document.getElementById("profile_image").click();
}

const fileValidation = (fileInput) => {
    let uploadSuccess = document.getElementById("imageUploadSuccess");
    let filePath = fileInput.value;
    let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if(!allowedExtensions.exec(filePath)){
        uploadSuccess.innerHTML = `
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex align-center justify-center">
                <div>
                    <p class="font-bold">Ве молиме прикачете од тип слика: .jpeg/.jpg/.png/.gif</p>
                </div>
            </div>
        </div>`;
        fileInput.value = '';
        return false;
    }
}
