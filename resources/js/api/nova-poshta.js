import axios from 'axios'

const BASE_URL = process.env.MIX_NP_API
const API_KEY = process.env.MIX_NP_API_KEY

/**
 * @see {@link https://devcenter.novaposhta.ua/docs/services/|Nova Poshta Dev Center}
 * @param {string} modelName
 * @param {string} calledMethod
 * @param {Record<string, any>} methodProperties
 * @return {Promise<any>}
 */
const requestNP = async (modelName, calledMethod, methodProperties) =>
  await axios.post(`${BASE_URL}/${modelName}/${calledMethod}`, {
    apiKey: API_KEY,
    modelName,
    calledMethod,
    methodProperties,
  })

export default {
  /**
   * @description Search by city name.
   * @see {@link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5ebeceea27017bc851d67|Nova Poshta Dev Center}
   * @param {string} cityName - City name.
   * @return {Promise<any>}
   */
  searchSettlements: async cityName =>
    await requestNP('Address', 'searchSettlements', {CityName: cityName}),
  /**
   * @description Search warehouses by city and search string.
   * @see {@link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45|Nova Poshta Dev Center}
   * @param {string} cityRef - City identifier.
   * @param {string} searchValue - Number or name of a warehouse.
   * @return {Promise<any>}
   */
  getWarehouses: async (cityRef, searchValue) =>
    await requestNP('AddressGeneral', 'getWarehouses', {CityRef: cityRef, FindByString: searchValue})
}
