import {createAnimation} from "@ionic/vue";

const fadeIn = (element) => {
    return createAnimation()
        .addElement(element)
        .duration(500)
        .fromTo('opacity', '0', '1')
}

export {
    fadeIn
};