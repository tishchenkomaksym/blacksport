/**
 * @description Scale a value from one range to another
 * @example scaleValue(33, [0, 100], [0, 65535])
 * @param value {number}
 * @param from {[number, number]}
 * @param to {[number, number]}
 * @return {number}
 */
export const scaleValue = (value, from, to) => {
  const scale = (to[1] - to[0]) / (from[1] - from[0])
  const capped = Math.min(from[1], Math.max(from[0], value)) - from[0]
  return ~~(capped * scale + to[0])
}
