/**
 * @description Scale a value from one range to another
 * @example scaleValue(33, [0, 100], [0, 65535])
 * @param value {number}
 * @param from {[number, number]}
 * @param to {[number, number]}
 * @return {number}
 */
export const scaleValue = (value, from, to) => {
  return (value - from[0]) * (to[1] - to[0]) / (from[1] - from[0]) + to[0]
}

/**
 * @description Convert HEX color to RGB
 * @param {string} hex - Color HEX.
 * @return {{r: number, b: number, g: number} | null}
 */
export const hexToRgb = hex => {
  const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex)
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16),
  } : null
}
