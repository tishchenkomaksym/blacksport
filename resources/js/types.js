/**
 * @typedef Article
 * @property {number} id
 * @property {string} description
 * @property {string} created_at
 * @property {string} images
 * @property {string} published
 * @property {string} title
 * @property {string} updated_at
 * @property {string} preview_image
 */

/**
 * @typedef ServiceExample
 * @property {number} id
 * @property {string} description
 * @property {string} created_at
 * @property {string} updated_at
 * @property {string} field
 * @property {string} media
 * @property {number} service_id
 */

/**
 * @typedef ServiceItem
 * @property {number} id
 * @property {string} created_at
 * @property {string} description
 * @property {string} name
 * @property {string} updated_at
 * @property {ServiceExample[]} examples
 */

/**
 * @typedef OrderServiceData
 * @property {number} service_id
 * @property {string} name
 * @property {string} email
 * @property {string} phone
 */

/**
 * @typedef Category
 * @property {number} id
 * @property {string} name
 * @property {string} url
 * @property {string} image
 * @property {string} created_at
 * @property {string} updated_at
 * @property {string} field
 */

/**
 * @typedef ProductItem
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
 * @property {Category} categories
 */

/**
 * @typedef Contacts
 * @property {string} address
 * @property {string} created_at
 * @property {string} email
 * @property {number} id
 * @property {string} phone
 * @property {string[]} social_links
 * @property {string} updated_at
 */

/**
 * @typedef Ambassador
 * @property {string} created_at
 * @property {string} description
 * @property {number} id
 * @property {string} image
 * @property {Array<any>} translations
 * @property {string} updated_at
 */

/**
 * @typedef Partner
 * @property {string} created_at
 * @property {string} description
 * @property {number} id
 * @property {string} image
 * @property {Array<any>} translations
 * @property {string} updated_at
 * @property {string} image_type
 */

/**
 * @typedef Achievement
 * @property {string} created_at
 * @property {string} description
 * @property {number }id
 * @property {string} title
 * @property {string} updated_at
 * @property {string} video
 */

/**
 * @typedef PageText
 * @property {string} created_at
 * @property {number} id
 * @property {string} name
 * @property {number} nofollow
 * @property {number} noindex
 * @property {string} page_key
 * @property {string} updated_at
 * @property {any[]} view_texts
 */

/**
 * @typedef About
 * @property {any[]} achievements
 * @property {Ambassador[]} ambassadors
 * @property {Partner[]} partners
 * @property {PageText[]} texts
 */

/**
 * @typedef Program
 * @property {string} created_at
 * @property {string} description
 * @property {number} id
 * @property {string} images
 * @property {string} name
 * @property {string} updated_at
 */
