/**
 * Codeally Block Variation Restrictions
 *
 * Listens for the window 'load' event to ensure Gutenberg has fully registered
 * all default block variations in memory before attempting to unregister them.
 */

window.addEventListener('load', () => {
    const embedBlockName = 'core/embed';
    const allowedEmbeds = ['pocket-casts', 'youtube', 'vimeo', 'spotify', 'videopress'];

    // Retrieve registered embed block variations
    const embedVariations = wp.blocks.getBlockVariations(embedBlockName);

    if (Array.isArray(embedVariations) && embedVariations.length > 0) {
        embedVariations.forEach(variation => {
            if (!allowedEmbeds.includes(variation.name)) {
                wp.blocks.unregisterBlockVariation(embedBlockName, variation.name);
            }
        });
    }

    // Unregister stretchy text variations if active
    wp.blocks.unregisterBlockVariation('core/heading', 'stretchy-heading');
    wp.blocks.unregisterBlockVariation('core/paragraph', 'stretchy-paragraph');
});