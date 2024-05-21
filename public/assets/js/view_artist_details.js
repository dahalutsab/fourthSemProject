// <script>
//     document.addEventListener('DOMContentLoaded', function() {
//     const urlParams = new URLSearchParams(window.location.search);
//     const artistData = urlParams.get('data');
//
//     if (artistData) {
//     const artist = JSON.parse(decodeURIComponent(artistData));
//
//     // Populate the artist details
//     document.querySelector('.artist-img-block img').src = artist.profilePicture ? artist.profilePicture : 'default-image.jpg';
//     document.querySelector('.text-block h2').textContent = artist.fullName ? artist.fullName : artist.stageName;
//     document.querySelector('.text-block .Stars').style.setProperty('--rating', 4.6);
//     document.querySelector('.text-block p').textContent = artist.description ? artist.description : 'No description available.';
//     // Populate other fields as needed
// } else {
//     console.error('No artist data found in the URL.');
// }
// });
// </script>
