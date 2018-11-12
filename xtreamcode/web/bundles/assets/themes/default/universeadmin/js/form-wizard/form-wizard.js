var FormWizard = /** @class */ (function () {
    function FormWizard(elementId, options) {
        if (options === void 0) { options = {}; }
        this.options = {
            currentClass: 'is-current',
            invalidClass: 'is-invalid',
            completedClass: 'is-completed',
            disabledClass: 'disabled'
        };
        this.currentStep = 1;
        this.totalStepsCount = 1;
        var self = this;
        this.elementId = elementId;
        this.options = this.extendOptions(this.options, options);
        this.prevControl = this.find('[data-step-control-prev]');
        this.nextControl = this.find('[data-step-control-next]');
        this.totalStepsCount = this.findAll('[data-step]').length;
        this.prevControl.addEventListener('click', function (e) {
            self.prevStep();
            e.preventDefault();
        });
        this.nextControl.addEventListener('click', function (e) {
            self.nextStep();
            e.preventDefault();
        });
    }
    FormWizard.prototype.prevStep = function () {
        if (this.currentStep > 1) {
            this.activateStep(this.currentStep, -1);
        }
    };
    FormWizard.prototype.nextStep = function () {
        if (this.currentStep < this.totalStepsCount) {
            this.activateStep(this.currentStep, +1);
        }
    };
    FormWizard.prototype.activateStep = function (stepNumber, increment) {
        this.currentStep = stepNumber + increment;
        var currentStepElement = this.find('[data-step="' + stepNumber + '"]');
        if (this.currentStep === 1) {
            this.addClass(this.prevControl, this.options.disabledClass);
        }
        else {
            this.removeClass(this.prevControl, this.options.disabledClass);
        }
        this.removeClass(currentStepElement, this.options.currentClass);
        if (increment >= 1) {
            this.removeClass(currentStepElement, this.options.currentClass);
            this.addClass(currentStepElement, this.options.completedClass);
        }
        else {
            this.removeClass(currentStepElement, this.options.completedClass);
        }
        var currentStepContentElement = this.find('[data-step-content="' + stepNumber + '"]');
        this.removeClass(currentStepContentElement, this.options.currentClass);
        var stepElement = this.find('[data-step="' + this.currentStep + '"]');
        this.removeClass(stepElement, this.options.completedClass);
        this.addClass(stepElement, this.options.currentClass);
        var stepContentElement = this.find('[data-step-content="' + this.currentStep + '"]');
        this.addClass(stepContentElement, this.options.currentClass);
    };
    FormWizard.prototype.find = function (selector) {
        return document.querySelector(this.elementId + ' ' + selector);
    };
    FormWizard.prototype.findAll = function (selector) {
        return document.querySelectorAll(this.elementId + ' ' + selector);
    };
    FormWizard.prototype.addClass = function (element, className) {
        element.classList.add(className);
    };
    FormWizard.prototype.removeClass = function (element, className) {
        element.classList.remove(className);
    };
    FormWizard.prototype.extendOptions = function (destination, source) {
        for (var property in source) {
            destination[property] = source[property];
        }
        return destination;
    };
    return FormWizard;
}());
