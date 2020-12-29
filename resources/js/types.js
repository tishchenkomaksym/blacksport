/**
 * @typedef {object} NewsItem
 * @property {number} id
 * @property {string} description
 * @property {string} created_at
 * @property {string} images
 * @property {string} published
 * @property {string} title
 * @property {string} updated_at
 */

/**
 * @typedef {object} ServiceExample
 * @property {number} id
 */

/**
 * @typedef {object} ServiceItem
 * @property {number} id
 * @property {string} created_at
 * @property {string} description
 * @property {string} name
 * @property {string} updated_at
 * @property {ServiceExample[]} examples
 */

/**
 * @typedef {object} ProductItem
 * @property {number} id
 * @property {number} category_id
 * @property {string} created_at
 * @property {string} description
 * @property {string} image
 * @property {number} order_count
 * @property {number} price
 * @property {string} specifications
 * @property {string} title
 * @property {string} updated_at
 */

/**
 * @typedef {object} Contacts
 * @property {string} address
 * @property {string} created_at
 * @property {string} email
 * @property {number} id
 * @property {string} phone
 * @property {string[]} social_links
 * @property {string} updated_at
 */

/**
 * @typedef {object} Ambassador
 * @property {string} created_at
 * @property {string} description
 * @property {number} id
 * @property {string} image
 * @property {Array<any>} translations
 * @property {string} updated_at
 */

/**
 * @typedef {object} Partner
 * @property {string} created_at
 * @property {string} description
 * @property {number} id
 * @property {string} image
 * @property {Array<any>} translations
 * @property {string} updated_at
 */

/**
 * @typedef {object} AboutText
 * @property {string} created_at
 * @property {number} id
 * @property {string} meta_description
 * @property {string} name
 * @property {number} nofollow
 * @property {number} noindex
 * @property {string} page_key
 * @property {Array<any>} translations
 * @property {string} updated_at
 * @property {Array<any>} view_texts
 */

/**
 * @typedef {object} About
 * @property {Ambassador[]} ambassadors
 * @property {Partner[]} partners
 * @property {AboutText[]} texts
 */
