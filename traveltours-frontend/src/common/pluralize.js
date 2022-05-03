export default (count, singular, plural) => {
  if (!plural) return `${count} ${singular}${count > 1 ? 's' : ''}`;
  return `${count} ${plural}`;
};
