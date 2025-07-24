// State management
const state = {
    personImage: null,
    clothImage: null,
    instructions: "",
    isDarkMode: localStorage.getItem("darkMode") === "true" || false,
    modelType: "",
    gender: "",
    garmentType: "",
    style: ""
};

// DOM Elements
const elements = {
    darkModeToggle: document.getElementById('darkModeToggle'),
    modelUpload: document.getElementById('modelUpload'),
    modelFileInput: document.getElementById('modelFileInput'),
    modelPreview: document.getElementById('modelPreview'),
    modelPreviewImage: document.getElementById('modelPreviewImage'),
    removeModel: document.getElementById('removeModel'),
    garmentUpload: document.getElementById('garmentUpload'),
    garmentFileInput: document.getElementById('garmentFileInput'),
    garmentPreview: document.getElementById('garmentPreview'),
    garmentPreviewImage: document.getElementById('garmentPreviewImage'),
    removeGarment: document.getElementById('removeGarment'),
    modelType: document.getElementById('modelType'),
    gender: document.getElementById('gender'),
    garmentType: document.getElementById('garmentType'),
    style: document.getElementById('style'),
    instructions: document.getElementById('instructions'),
    toastContainer: document.getElementById('toastContainer')
};

// Initialize app
function init() {
    // Set dark mode based on saved preference
    setDarkMode(state.isDarkMode);

    // Event listeners
    setupEventListeners();
}

// Set dark mode
function setDarkMode(isDark) {
    state.isDarkMode = isDark;
    document.body.classList.toggle('dark', isDark);
    localStorage.setItem('darkMode', isDark);

    // Update toggle icon
    const icon = elements.darkModeToggle.querySelector('i');
    icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
}

// Setup all event listeners
function setupEventListeners() {
    // Dark mode toggle
    elements.darkModeToggle.addEventListener('click', () => {
        setDarkMode(!state.isDarkMode);
    });

    // Model image upload
    elements.modelUpload.addEventListener('click', () => {
        elements.modelFileInput.click();
    });
    elements.modelFileInput.addEventListener('change', (e) => {
        handleFileUpload(e.target.files[0], 'model');
    });
    elements.removeModel.addEventListener('click', () => {
        removeImage('model');
    });

    // Garment image upload
    elements.garmentUpload.addEventListener('click', () => {
        elements.garmentFileInput.click();
    });
    elements.garmentFileInput.addEventListener('change', (e) => {
        handleFileUpload(e.target.files[0], 'garment');
    });
    elements.removeGarment.addEventListener('click', () => {
        removeImage('garment');
    });

    // Form dropdowns
    elements.modelType.addEventListener('change', (e) => {
        state.modelType = e.target.value;
    });
    elements.gender.addEventListener('change', (e) => {
        state.gender = e.target.value;
    });
    elements.garmentType.addEventListener('change', (e) => {
        state.garmentType = e.target.value;
    });
    elements.style.addEventListener('change', (e) => {
        state.style = e.target.value;
    });

    // Instructions
    elements.instructions.addEventListener('input', (e) => {
        state.instructions = e.target.value;
    });

    // Drag and drop for upload areas
    setupDragAndDrop(elements.modelUpload, 'model');
    setupDragAndDrop(elements.garmentUpload, 'garment');
    document.getElementById('tryonForm').addEventListener('submit', (e) => {
        const submitBtn = document.getElementById('submitTryOn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Đang xử lý...';
    });
}

// Handle file upload
function handleFileUpload(file, type) {
    if (!file) return;

    const isImage = file.type.startsWith("image/");
    if (!isImage) {
        showToast("Vui lòng chỉ tải lên tệp hình ảnh!", "error");
        return;
    }

    const isLt10M = file.size / 1024 / 1024 < 10;
    if (!isLt10M) {
        showToast("Hình ảnh phải nhỏ hơn 10MB!", "error");
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        if (type === 'model') {
            state.personImage = file;
            elements.modelPreviewImage.src = e.target.result;
            elements.modelPreview.classList.remove('hidden');
            elements.modelUpload.classList.add('hidden');
        } else {
            state.clothImage = file;
            elements.garmentPreviewImage.src = e.target.result;
            elements.garmentPreview.classList.remove('hidden');
            elements.garmentUpload.classList.add('hidden');
        }
    };
    reader.readAsDataURL(file);
}

// Remove image
function removeImage(type) {
    if (type === 'model') {
        state.personImage = null;
        elements.modelPreview.classList.add('hidden');
        elements.modelUpload.classList.remove('hidden');
        elements.modelFileInput.value = '';
    } else {
        state.clothImage = null;
        elements.garmentFileInput.value = '';
        if (state.defaultClothImageUrl) {
            // Revert to default product image
            elements.garmentPreviewImage.src = state.defaultClothImageUrl;
            elements.garmentPreview.classList.remove('hidden');
            elements.garmentUpload.classList.add('hidden');
        } else {
            // Show upload area if no default image
            elements.garmentPreview.classList.add('hidden');
            elements.garmentUpload.classList.remove('hidden');
        }
    }
}

// Setup drag and drop
function setupDragAndDrop(element, type) {
    element.addEventListener('dragover', (e) => {
        e.preventDefault();
        element.classList.add('border-blue-500');
    });

    element.addEventListener('dragleave', () => {
        element.classList.remove('border-blue-500');
    });

    element.addEventListener('drop', (e) => {
        e.preventDefault();
        element.classList.remove('border-blue-500');
        if (e.dataTransfer.files.length) {
            handleFileUpload(e.dataTransfer.files[0], type);
        }
    });
}

// Show toast notification
function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            `;

    elements.toastContainer.appendChild(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

// Initialize the app
init();